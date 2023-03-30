<?php

namespace App\Http\Controllers;

use App\Models\Moving;
use App\Models\MovingDetail;
use Illuminate\Http\Request;
use App\Exports\SummaryIpaExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportSummaryIpaController extends Controller
{
    public function index()
    {
        $report_name = 'Summary IPA';
        return view('reports.summary_ipa.index', compact('report_name'));
    }

    public function display(Request $request)
    {
        $report_name = 'Summary IPA';
        $date = $request->date;
        $month = substr($date, 5, 2);
        $year = substr($date, 0, 4);

        $movings = Moving::whereMonth('ipa_date', $month)
            ->whereYear('ipa_date', $year)
            ->get();

        // get moving_details for each moving
        foreach ($movings as $moving) {
            $moving->moving_details = $this->moving_details($moving->id);
        }

        // get equipments for each moving_detail



        return view('reports.summary_ipa.display', compact('date', 'report_name', 'movings'));
    }

    public function moving_details($moving_id)
    {
        $moving_details = MovingDetail::where('moving_id', $moving_id)->get();
        return $moving_details;
    }

    public function export(Request $request)
    {
        $date = $request->date;
        $month = substr($date, 5, 2);
        $year = substr($date, 0, 4);

        $movings = Moving::whereMonth('ipa_date', $month)
            ->whereYear('ipa_date', $year)
            ->get();

        return Excel::download(new SummaryIpaExport($movings, $date), 'summary_ipa.xlsx');
    }
}
