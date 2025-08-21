<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Home;
use App\Models\Appointment;
use App\Models\TitleMonitoring; // Assuming TitleMonitoring model exists
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmation;
use Exception; // Import Exception class

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function process(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:50',
            'zip_code' => 'nullable|string|max:10',
            'preferred_date' => 'required|date|after:today|before:' . now()->addDays(8)->format('Y-m-d'),
            'preferred_time' => 'required|string',
            'receipts_ready' => 'required|accepted',
            'agree_terms' => 'required|accepted'
        ]);

        try {
            // Find existing user or create new one
            $user = User::where('email', $validated['email'])->first();
            
            if ($user) {
                // Update existing user's information if needed
                $user->update([
                    'name' => $validated['name'],
                    'phone' => $validated['phone']
                ]);
            } else {
                // Create new user
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'password' => bcrypt(Str::random(12)) // Temporary password
                ]);
            }

            // Assign homeowner role
            if (!$user->hasRole('homeowner')) {
                $user->assignRole('homeowner');
            }

            // Create home record with parsed address
            $home = Home::create([
                'owner_id' => $user->id,
                'address' => $validated['address'],
                'city' => $validated['city'] ?? '',
                'state' => $validated['state'] ?? '',
                'zip_code' => $validated['zip_code'] ?? ''
            ]);

            // Create appointment
            $appointmentDateTime = $validated['preferred_date'] . ' ' . $validated['preferred_time'];
            $appointment = Appointment::create([
                'home_id' => $home->id,
                'scheduled_at' => $appointmentDateTime,
                'status' => 'scheduled',
                'estimated_duration' => 2.0
            ]);

            // Handle title monitoring if selected
            if ($validated['title_monitoring'] ?? false) {
                // Assuming TitleMonitoring model and its properties are correctly defined elsewhere
                TitleMonitoring::create([
                    'home_id' => $home->id,
                    'status' => 'pending',
                    'monthly_fee' => 50.00
                ]);
            }

            // Store appointment ID in session for confirmation page
            session(['appointment_id' => $appointment->id]);

            // Send welcome email (you can create a job for this)
            // Mail::to($user->email)->send(new AppointmentConfirmation($appointment));

            return redirect()->route('checkout.confirmation');

        } catch (Exception $e) {
            // Log the error for debugging
            \Log::error('Checkout process failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Something went wrong. Please try again.'])->withInput();
        }
    }

    public function confirmation()
    {
        $appointmentId = session('appointment_id');

        if (!$appointmentId) {
            return redirect()->route('checkout.index');
        }

        // Ensure the home.owner relationship is loaded
        $appointment = Appointment::with(['home.owner'])->find($appointmentId);

        if (!$appointment) {
            return redirect()->route('checkout.index');
        }

        // Send confirmation email if not already sent or if needed again
        // Mail::to($appointment->home->owner->email)->send(new AppointmentConfirmation($appointment));


        return view('checkout.confirmation', compact('appointment'));
    }
}