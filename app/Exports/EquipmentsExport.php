<?php

namespace App\Exports;

use App\Models\Equipment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EquipmentsExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $equipments = Equipment::with(['unitmodel', 'category', 'unitstatus', 'current_project', 'plant_type', 'asset_category', 'plant_group'])->get();
        return view('equipments.export', compact('equipments'));
    }
}
