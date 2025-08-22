<?php

namespace App\Http\Controllers\Homeowner;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $reports = Report::whereHas('appointment.home', function($query) use ($user) {
            $query->where('owner_id', $user->id);
        })->with(['appointment.home', 'generatedBy'])->orderBy('created_at', 'desc')->paginate(10);

        return view('homeowner.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        $this->authorize('view', $report);
        
        return view('homeowner.reports.show', compact('report'));
    }

    public function download(Report $report)
    {
        $this->authorize('view', $report);
        
        // Logic to download PDF report
        return response()->download($report->file_path);
    }
}
