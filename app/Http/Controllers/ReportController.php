<?php

namespace App\Http\Controllers;

use App\Models\Civillian;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
}
