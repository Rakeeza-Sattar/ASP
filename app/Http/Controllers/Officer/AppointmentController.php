<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $officer = Auth::user();
        $appointments = $officer->officerAppointments()
            ->with(['home.owner'])
            ->orderBy('scheduled_date', 'desc')
            ->paginate(10);

        return view('officer.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);
        
        return view('officer.appointments.show', compact('appointment'));
    }

    public function start(Appointment $appointment)
    {
        $this->authorize('update', $appointment);
        
        $appointment->update(['status' => 'in_progress']);
        
        return response()->json(['success' => true]);
    }

    public function document(Appointment $appointment)
    {
        $this->authorize('update', $appointment);
        
        return view('officer.appointments.document', compact('appointment'));
    }
}
