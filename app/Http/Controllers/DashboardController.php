<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('contents.main');
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
