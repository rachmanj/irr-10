<?php

namespace App\Exports;

use App\Models\HazardReport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HazardReportExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $hazard_reports = HazardReport::orderBy('created_at', 'desc')->get();
        return view('hazard-rpt.export', compact('hazard_reports'));
    }
}
