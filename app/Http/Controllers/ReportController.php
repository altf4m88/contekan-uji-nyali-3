<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Civillian;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function create(Request $request) {
        $civillian = Civillian::where('id', $request->civillian_id)->get();

        if(count($civillian) < 1) {

            $newCivillian = new Civillian;

            $newCivillian->id = $request->civillian_id;
            $newCivillian->name = $request->name;
            $newCivillian->save();

            $report = new Report;
            $report->civillian_id = $newCivillian->id;
            $report->report = $request->report;
            $report->photo = $request->file('photo')->getClientOriginalName();
            $report->status = Report::DRAFT;

            $request->photo->storeAs('images', $report->photo, 'public_uploads');

            $report->save();
        } else {
            $civillian = $civillian->first();

            $report = new Report;
            $report->civillian_id = $civillian->id;
            $report->report = $request->report;
            $report->photo = $request->file('photo')->getClientOriginalName();
            $report->status = Report::DRAFT;

            $request->photo->storeAs('images', $report->photo, 'public_uploads');

            $report->save();
        }

        return redirect('/')->with('success', 'Sukses membuat pengaduan baru. Pengaduan anda akan diproses oleh petugas.');

    }

    public function employeeReports(Request $request) {
        $user = Auth::user();

        $reports = Report::with('civillian')->orderBy('created_at', 'desc');

        if(isset($request->civillian_name)) {
            $reports->whereHas('civillian', function($query) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->civillian_name.'%');
            });
        }

        $reports = collect($reports->paginate(20));

        return view('contents.employee.reports')
            ->with('reports', $reports)
            ->with('user', $user);
    }

    public function adminReports(Request $request) {
        $user = Auth::user();

        $reports = Report::with('civillian')->orderBy('created_at', 'desc');

        if(isset($request->civillian_name)) {
            $reports->whereHas('civillian', function($query) use ($request) {
                $query->where('name', 'LIKE', '%'.$request->civillian_name.'%');
            });
        }

        $reports = collect($reports->paginate(20));

        return view('contents.admin.reports')
            ->with('reports', $reports)
            ->with('user', $user);
    }

    public function detail(Request $request) {
        $report = Report::with('civillian')->findOrFail($request->id);

        return response()->json($report);
    }

    public function update(Request $request) {
        $report = Report::findOrFail($request->id);

        $report->status = $request->status;
        $report->save();

        return redirect()->back()->with('success-update', 'Sukses mengganti status laporan.');
    }

    public function delete(Request $request) {
        Report::findOrFail($request->id)->delete();

        return response()->json('ok');
    }

    public function print($id) {
        $user = Auth::user();

        $report = Report::with('civillian')->findOrFail($id);

        $now = Carbon::now('Asia/Jakarta')->locale('id_ID');

        $date = $now->day.' '.$now->monthName.' '.$now->year;

        $createdDate = Carbon::createFromDate($report->created_at)->locale('id_ID')->tz('Asia/Jakarta');

        $createdAt = $createdDate->hour.':'. $createdDate->minute .' '.$createdDate->day.' '.$createdDate->monthName.' '.$createdDate->year;

        $statuses = [
            'DRAFT' => 'Belum diprosess',
            'ONPROGRESS' => 'Sedang diproses',
            'DONE' => 'Sudah diproses',
        ];

        $data = [
            'status' => $statuses[$report->status],
            'createdAt' => $createdAt,
            'currentDate' => $date,
            'user' => $user,
            'report' => $report,
        ];

        // return view('contents.admin.print_report')->with('data', $data);

        $pdf = PDF::loadView('contents.admin.print_report', $data);

        return $pdf->stream('invoice.pdf');
    }

    public function printReports(Request $request, $id) {
        $user = Auth::user();

    }
}
