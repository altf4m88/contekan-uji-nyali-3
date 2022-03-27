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

        $draftReport = Report::with('civillian')->orderBy('created_at', 'desc')->where('status', Report::DRAFT)->limit(3)->get();
        $onProgressReport = Report::with('civillian')->orderBy('created_at', 'desc')->where('status', Report::ONPROGRESS)->limit(3)->get();
        $doneReport = Report::with('civillian')->orderBy('created_at', 'desc')->where('status', Report::DONE)->limit(3)->get();

        return view('contents.main')
                ->with('draftReport', $draftReport)
                ->with('onProgressReport', $onProgressReport)
                ->with('doneReport', $doneReport);
    }

    public function reports() {
        $draftReport = Report::with('civillian')->orderBy('created_at', 'desc')->where('status', Report::DRAFT)->limit(3)->get();
        $onProgressReport = Report::with('civillian')->orderBy('created_at', 'desc')->where('status', Report::ONPROGRESS)->limit(3)->get();
        $doneReport = Report::with('civillian')->orderBy('created_at', 'desc')->where('status', Report::DONE)->limit(3)->get();

        return view('contents.report')
                    ->with('draftReport', $draftReport)
                    ->with('onProgressReport', $onProgressReport)
                    ->with('doneReport', $doneReport);
    }

    public function adminDashboard() {
        $user = Auth::user();

        $reports = Report::with('civillian')->orderBy('created_at', 'desc');

        $latestReports = $reports->limit(3)->get();
        $draftReports = Report::with('civillian')->orderBy('created_at', 'desc')->where('status', Report::DRAFT)->count();
        $onProgressReports = Report::with('civillian')->orderBy('created_at', 'desc')->where('status', Report::ONPROGRESS)->count();
        $doneReports = Report::with('civillian')->orderBy('created_at', 'desc')->where('status', Report::DONE)->count();

        return view('contents.admin.dashboard')
                ->with('user', $user)
                ->with('latestReports', $latestReports)
                ->with('draftReports', $draftReports)
                ->with('onProgressReports', $onProgressReports)
                ->with('doneReports', $doneReports);
    }

    public function employeeDashboard() {
        $user = Auth::user();

        $reports = Report::with('civillian')->orderBy('created_at', 'desc');

        $latestReports = $reports->limit(3)->get();
        $draftReports = Report::with('civillian')->orderBy('created_at', 'desc')->where('status', Report::DRAFT)->count();
        $onProgressReports = Report::with('civillian')->orderBy('created_at', 'desc')->where('status', Report::ONPROGRESS)->count();
        $doneReports = Report::with('civillian')->orderBy('created_at', 'desc')->where('status', Report::DONE)->count();

        return view('contents.employee.dashboard')
                ->with('user', $user)
                ->with('latestReports', $latestReports)
                ->with('draftReports', $draftReports)
                ->with('onProgressReports', $onProgressReports)
                ->with('doneReports', $doneReports);
    }
}
