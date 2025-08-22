<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use Yajra\DataTables\DataTables;


class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
    
    public function appointments(Request $request)
    {
        if ($request->ajax()) {
            $appointments = Appointment::with(['home', 'homeowner', 'officer'])->latest();
            
            return DataTables::of($appointments)
                ->addColumn('homeowner_name', function ($appointment) {
                    return $appointment->homeowner->name;
                })
                ->addColumn('address', function ($appointment) {
                    return $appointment->home->address;
                })
                ->addColumn('status_badge', function ($appointment) {
                    $class = match($appointment->status) {
                        'pending' => 'warning',
                        'confirmed' => 'info', 
                        'completed' => 'success',
                        'cancelled' => 'danger'
                    };
                    return '<span class="badge bg-'.$class.'">'.$appointment->status.'</span>';
                })
                ->rawColumns(['status_badge'])
                ->make(true);
        }
        
        return view('dashboard.appointments');
    }
}

