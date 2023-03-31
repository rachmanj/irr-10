<?php

namespace App\Exports;

use App\Models\Equipment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UnitStatusExport implements FromView
{
    private $equipments;

    public function __construct($equipments)
    {
        $this->equipments = $equipments;
    }

    public function view(): View
    {
        $equipments = $this->equipments;

        return view('reports.active_status.export', compact('equipments'));
    }
}
