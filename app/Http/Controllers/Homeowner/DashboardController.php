<?php

namespace App\Http\Controllers\Homeowner;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Report;
use App\Models\Item;
use App\Models\Payment;
use App\Models\TitleMonitoring;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $home = $user->homes()->first();

        // Basic Statistics
        $stats = [
            'total_appointments' => $user->appointments()->count(),
            'pending_appointments' => $user->appointments()->where('status', 'scheduled')->count(),
            'completed_appointments' => $user->appointments()->where('status', 'completed')->count(),
            'in_progress_appointments' => $user->appointments()->where('status', 'in_progress')->count(),
            'total_items' => $home ? $home->items()->count() : 0,
            'total_reports' => $home ? $home->reports()->count() : 0,
            'audit_reports' => $home ? $home->reports()->where('type', 'audit')->count() : 0,
            'incident_reports' => $home ? $home->reports()->where('type', 'incident')->count() : 0,
            'total_payments' => $user->payments()->sum('amount'),
            'title_monitoring_active' => $home ? $home->titleMonitoring()->where('status', 'active')->exists() : false,
        ];

        // Recent Activity
        $recentAppointments = $user->appointments()
            ->with(['home', 'officer'])
            ->latest()
            ->take(5)
            ->get();

        $recentReports = $home ? $home->reports()
            ->with(['appointment', 'officer'])
            ->latest()
            ->take(5)
            ->get() : collect();

        $upcomingAppointments = $user->appointments()
            ->where('status', 'scheduled')
            ->where('scheduled_date', '>=', Carbon::now())
            ->orderBy('scheduled_date')
            ->take(3)
            ->get();

        // Monthly data for charts
        $monthlyAppointments = $user->appointments()
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $monthlyPayments = $user->payments()
            ->selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'COMPLETED')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return view('homeowner.dashboard', compact(
            'stats',
            'recentAppointments',
            'recentReports',
            'upcomingAppointments',
            'monthlyAppointments',
            'monthlyPayments',
            'home'
        ));
    }
}
