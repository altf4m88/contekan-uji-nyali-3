<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
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
}
