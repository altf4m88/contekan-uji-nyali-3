<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Report;
use Carbon\Carbon;
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

        $draftReport = collect($draftReport)->map(function ($item, $key) {
            $createdDate = Carbon::createFromDate($item['created_at'])->locale('id_ID')->tz('Asia/Jakarta');

            $item['localized_date'] = 'Dibuat pada tanggal '.$createdDate->day.' '.$createdDate->monthName.' '.$createdDate->year.' pukul '. $createdDate->hour.':'.$createdDate->minute;

            return $item;
        });

        $onProgressReport = collect($onProgressReport)->map(function ($item, $key) {
            $createdDate = Carbon::createFromDate($item['created_at'])->locale('id_ID')->tz('Asia/Jakarta');

            $item['localized_date'] = 'Dibuat pada tanggal '.$createdDate->day.' '.$createdDate->monthName.' '.$createdDate->year.' pukul '. $createdDate->hour.':'.$createdDate->minute;

            return $item;
        });

        $doneReport = collect($doneReport)->map(function ($item, $key) {
            $createdDate = Carbon::createFromDate($item['created_at'])->locale('id_ID')->tz('Asia/Jakarta');

            $item['localized_date'] = 'Dibuat pada tanggal '.$createdDate->day.' '.$createdDate->monthName.' '.$createdDate->year.' pukul '. $createdDate->hour.':'.$createdDate->minute;

            return $item;
        });

        return view('contents.main')
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

        $latestReports = collect($latestReports)->map(function ($item, $key) {
            $createdDate = Carbon::createFromDate($item['created_at'])->locale('id_ID')->tz('Asia/Jakarta');

            $item['localized_date'] = $createdDate->day.' '.$createdDate->monthName.' '.$createdDate->year;

            return $item;
        });

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

        $latestReports = collect($latestReports)->map(function ($item, $key) {
            $createdDate = Carbon::createFromDate($item['created_at'])->locale('id_ID')->tz('Asia/Jakarta');

            $item['localized_date'] = $createdDate->day.' '.$createdDate->monthName.' '.$createdDate->year;

            return $item;
        });

        return view('contents.employee.dashboard')
                ->with('user', $user)
                ->with('latestReports', $latestReports)
                ->with('draftReports', $draftReports)
                ->with('onProgressReports', $onProgressReports)
                ->with('doneReports', $doneReports);
    }
}
