<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Report;
use App\Models\Item;
use App\Models\Home;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Basic Statistics
        $stats = [
            'total_assignments' => $user->assignedAppointments()->count(),
            'pending_assignments' => $user->assignedAppointments()->where('status', 'scheduled')->count(),
            'completed_assignments' => $user->assignedAppointments()->where('status', 'completed')->count(),
            'in_progress_assignments' => $user->assignedAppointments()->where('status', 'in_progress')->count(),
            'total_homes_visited' => $user->assignedAppointments()->where('status', 'completed')->distinct('home_id')->count(),
            'total_items_documented' => $user->documentedItems()->count(),
            'total_reports_generated' => $user->reports()->count(),
            'audit_reports' => $user->reports()->where('type', 'audit')->count(),
            'incident_reports' => $user->reports()->where('type', 'incident')->count(),
            'today_appointments' => $user->assignedAppointments()
                ->whereDate('scheduled_date', Carbon::today())
                ->count(),
        ];

        // Recent Activity
        $recentAppointments = $user->assignedAppointments()
            ->with(['home.owner', 'homeowner'])
            ->latest()
            ->take(5)
            ->get();

        $recentReports = $user->reports()
            ->with(['appointment.home'])
            ->latest()
            ->take(5)
            ->get();

        // Today's Schedule
        $todayAppointments = $user->assignedAppointments()
            ->with(['home.owner'])
            ->whereDate('scheduled_date', Carbon::today())
            ->orderBy('scheduled_time')
            ->get();

        // Upcoming Assignments
        $upcomingAppointments = $user->assignedAppointments()
            ->where('status', 'scheduled')
            ->where('scheduled_date', '>', Carbon::today())
            ->orderBy('scheduled_date')
            ->take(5)
            ->get();

        // Monthly Performance Data
        $monthlyAppointments = $user->assignedAppointments()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $monthlyCompleted = $user->assignedAppointments()
            ->selectRaw('MONTH(updated_at) as month, COUNT(*) as count')
            ->where('status', 'completed')
            ->whereYear('updated_at', Carbon::now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        return view('officer.dashboard', compact(
            'stats',
            'recentAppointments',
            'recentReports',
            'todayAppointments',
            'upcomingAppointments',
            'monthlyAppointments',
            'monthlyCompleted'
        ));
    }
}
