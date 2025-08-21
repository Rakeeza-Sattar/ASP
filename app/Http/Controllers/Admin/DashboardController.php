<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\AppointmentsDataTable;
use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Item;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'scheduled')->count(),
            'completed_appointments' => Appointment::where('status', 'completed')->count(),
            'total_revenue' => Payment::where('status', 'COMPLETED')->sum('amount'),
            'total_items' => Item::count(),
        ];

        $recentAppointments = Appointment::with(['home.owner', 'officer'])
            ->latest()
            ->take(5)
            ->get();

        $recentPayments = Payment::with('user')
            ->where('status', 'COMPLETED')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentAppointments', 'recentPayments'));
    }

    public function appointments(AppointmentsDataTable $dataTable)
    {
        return $dataTable->render('admin.appointments.index');
    }

    public function users(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }
}

