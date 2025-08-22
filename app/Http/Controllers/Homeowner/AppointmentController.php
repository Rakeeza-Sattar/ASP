<?php

namespace App\Http\Controllers\Homeowner;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Home;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $appointments = Appointment::whereHas('home', function($query) use ($user) {
            $query->where('owner_id', $user->id);
        })->with(['home', 'officer'])->orderBy('scheduled_date', 'desc')->paginate(10);

        return view('homeowner.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $homes = \Illuminate\Support\Facades\Auth::user()->homes;
        $availableDates = collect();
        
        // Generate next 7 days as available dates
        for ($i = 1; $i <= 7; $i++) {
            $availableDates->push(Carbon::now()->addDays($i));
        }

        return view('homeowner.appointments.create', compact('homes', 'availableDates'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_id' => 'required|exists:homes,id',
            'scheduled_date' => 'required|date|after:today',
            'scheduled_time' => 'required',
            'notes' => 'nullable|string|max:500'
        ]);

        $appointment = Appointment::create([
            'home_id' => $validated['home_id'],
            'scheduled_date' => $validated['scheduled_date'],
            'scheduled_time' => $validated['scheduled_time'],
            'notes' => $validated['notes'],
            'status' => 'scheduled'
        ]);

        return redirect()->route('homeowner.appointments.index')
            ->with('success', 'Appointment scheduled successfully!');
    }

    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);
        
        return view('homeowner.appointments.show', compact('appointment'));
    }
}
