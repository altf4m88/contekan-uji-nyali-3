<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {

        $user = Auth::user();

        if($user){
            if($user->role === Employee::ADMIN) {
                return redirect('/admin-dashboard');
            } else if ($user->role === Employee::EMPLOYEE) {
                return redirect('/employee-dashboard');
            }
        }

        $reports = Report::with('civillian')->orderBy('created_at', 'desc');

        $draftReport = $reports->where('status', Report::DRAFT)->limit(3)->get();
        $onProgressReport = $reports->where('status', Report::ONPROGRESS)->limit(3)->get();
        $doneReport = $reports->where('status', Report::DONE)->limit(3)->get();

        return view('contents.main')
                    ->with('draftReport', $draftReport)
                    ->with('onProgressReport', $onProgressReport)
                    ->with('doneReport', $doneReport);
    }

    public function reports() {

        $reports = Report::with('civillian')->orderBy('created_at', 'desc');

        $draftReport = $reports->where('status', Report::DRAFT)->get();
        $onProgressReport = $reports->where('status', Report::ONPROGRESS)->get();
        $doneReport = $reports->where('status', Report::DONE)->get();

        return view('contents.report')
                    ->with('draftReport', $draftReport)
                    ->with('onProgressReport', $onProgressReport)
                    ->with('doneReport', $doneReport);
    }

    public function adminDashboard() {
        $user = Auth::user();

        $reports = Report::with('civillian')->orderBy('created_at', 'desc');

        $latestReports = $reports->limit(3)->get();
        $draftReports = $reports->where('status', Report::DRAFT)->get()->count();
        $onProgressReports = $reports->where('status', Report::ONPROGRESS)->get()->count();
        $doneReports = $reports->where('status', Report::DONE)->get()->count();

        return view('contents.admin.dashboard')
                ->with('user', $user)
                ->with('latestReports', $latestReports)
                ->with('draftReports', $draftReports)
                ->with('onProgressReports', $onProgressReports)
                ->with('doneReports', $doneReports);
    }
}
