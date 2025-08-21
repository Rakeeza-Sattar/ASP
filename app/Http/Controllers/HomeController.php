<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Home;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Store appointment from landing page
     */
    public function storeAppointment(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'preferred_date' => 'required|date|after:today|before:' . Carbon::now()->addDays(8)->toDateString(),
            'preferred_time' => 'required|string',
            'receipts_ready' => 'accepted',
        ]);

        try {
            DB::beginTransaction();

            // Create user account
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make(Str::random(12)), // Random password
                'email_verified_at' => now(),
            ]);

            $user->assignRole('homeowner');

            // Create home record
            $addressParts = explode(',', $request->address);
            $home = Home::create([
                'owner_id' => $user->id,
                'address' => trim($addressParts[0] ?? $request->address),
                'city' => trim($addressParts[1] ?? 'Unknown'),
                'state' => trim($addressParts[2] ?? 'Unknown'),
                'zip_code' => trim($addressParts[3] ?? '00000'),
                'property_type' => 'residential',
            ]);

            // Create appointment
            $scheduledAt = Carbon::createFromFormat('Y-m-d H:i', 
                $request->preferred_date . ' ' . $request->preferred_time);

            $appointment = Appointment::create([
                'home_id' => $home->id,
                'scheduled_at' => $scheduledAt,
                'status' => 'scheduled',
                'special_instructions' => 'New customer - first audit',
                'preparation_checklist' => [
                    'Receipts gathered',
                    'Valuables organized',
                    'Warranty papers ready'
                ]
            ]);

            // Send welcome email
            \App\Jobs\SendWelcomeEmail::dispatch($user, $appointment);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Appointment scheduled successfully!',
                'redirect_url' => route('appointment.confirmation', ['appointment' => $appointment->id])
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Error scheduling appointment: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show appointment confirmation
     */
    public function appointmentConfirmation(Request $request)
    {
        $appointmentId = $request->get('appointment');
        $appointment = Appointment::with(['home.owner'])->find($appointmentId);
        
        if (!$appointment) {
            return redirect()->route('home')->with('error', 'Appointment not found.');
        }

        return view('appointment.confirmation', compact('appointment'));
    }
}
