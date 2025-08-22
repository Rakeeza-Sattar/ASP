<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Jobs\SendWelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Show the landing page
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Store appointment from landing page
     */
    public function storeAppointment(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'appointment_date' => 'required|date|after_or_equal:today|before_or_equal:' . Carbon::now()->addDays(7)->toDateString(),
            'preferred_time' => 'required|string',
            'valuables_ready' => 'required|accepted'
        ]);

        try {
            // Create or find user
            $user = User::where('email', $request->email)->first();
            
            if (!$user) {
                // Split full name
                $nameParts = explode(' ', $request->full_name, 2);
                $firstName = $nameParts[0];
                $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

                $user = User::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make(Str::random(12)), // Random password
                    'role' => 'homeowner',
                    'email_verified_at' => now()
                ]);

                // Assign homeowner role
                $user->assignRole('homeowner');
            }

            // Create appointment
            $appointmentDateTime = Carbon::parse($request->appointment_date . ' ' . $request->preferred_time);
            
            $appointment = Appointment::create([
                'user_id' => $user->id,
                'appointment_date' => $appointmentDateTime,
                'status' => 'scheduled',
                'address' => $request->address,
                'notes' => 'Booked through website. Customer confirmed valuables will be ready.',
                'service_type' => 'home_audit',
                'estimated_duration' => 60 // 1 hour
            ]);

            // Send welcome email with appointment details
            SendWelcomeEmail::dispatch($user, $appointment);

            return response()->json([
                'success' => true,
                'message' => 'Appointment booked successfully!',
                'redirect_url' => route('appointment.confirmation', ['appointment' => $appointment->id])
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error booking appointment: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show appointment confirmation page
     */
    public function appointmentConfirmation(Request $request)
    {
        $appointmentId = $request->query('appointment');
        
        if (!$appointmentId) {
            return redirect('/')->with('error', 'Invalid appointment reference.');
        }

        $appointment = Appointment::with('user')->find($appointmentId);
        
        if (!$appointment) {
            return redirect('/')->with('error', 'Appointment not found.');
        }

        return view('appointment.confirmation', compact('appointment'));
    }
}
