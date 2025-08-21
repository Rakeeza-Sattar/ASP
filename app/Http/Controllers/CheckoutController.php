<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }
    
    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string',
            'address' => 'required|string',
            'preferred_date' => 'required|date|after:today|before:' . now()->addDays(7),
            'receipts_ready' => 'required|accepted'
        ]);
        
        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make(Str::random(12)),
            'role' => 'homeowner'
        ]);
        
        // Create home
        $home = Home::create([
            'user_id' => $user->id,
            'address' => $request->address,
            'city' => $request->city ?? '',
            'state' => $request->state ?? '',
            'zip_code' => $request->zip_code ?? ''
        ]);
        
        // Create appointment
        $appointment = Appointment::create([
            'home_id' => $home->id,
            'user_id' => $user->id,
            'scheduled_date' => $request->preferred_date,
            'status' => 'pending'
        ]);
        
        return redirect()->route('checkout.confirmation', $appointment->id);
    }
    public function confirmation($appointmentId)
{
    $appointment = Appointment::with(['home', 'homeowner'])->findOrFail($appointmentId);
    
    // Send confirmation email
    Mail::to($appointment->homeowner->email)->send(new AppointmentConfirmation($appointment));
    
    return view('checkout.confirmation', compact('appointment'));
}
}
