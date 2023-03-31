<?php

namespace App\Http\Controllers;

use App\Exports\UnitStatusExport;
use App\Models\Equipment;
use Maatwebsite\Excel\Facades\Excel;

class ReportActiveStatusController extends Controller
{
    public function index()
    {
        return view('reports.active_status.index');
    }

    public function data()
    {
        $equipments = $this->getData();

        return datatables()->of($equipments)
            ->addColumn('model', function ($equipments) {
                return $equipments->unitmodel->model_no;
            })
            ->addColumn('manufacture', function ($equipments) {
                return $equipments->unitmodel->manufacture->name;
            })
            ->addColumn('plant_type', function ($equipments) {
                return $equipments->plant_type->name;
            })
            ->addColumn('current_project', function ($equipments) {
                return $equipments->current_project->project_code;
            })
            ->addColumn('asset_category', function ($equipments) {
                return $equipments->asset_category->name;
            })
            ->addColumn('status', function ($equipment) {
                if ($equipment->unitstatus_id === 1) {
                    return '<button class="btn btn-outline-success btn-sm" style="pointer-events: none">active</button>';
                } else {
                    return '<button class="btn btn-outline-danger btn-sm" style="pointer-events: none">in-active</button>';
                }
            })
            ->addIndexColumn()
            ->rawColumns(['status'])
            ->toJson();
    }

    public function getData()
    {
        return Equipment::where('unitstatus_id', 1)
            ->orWhere('unitstatus_id', 2)
            ->orderBy('current_project_id', 'asc')
            ->orderBy('unitstatus_id', 'asc')
            ->get();
    }

    public function export()
    {
        $equipment = $this->getData();

        return Excel::download(new UnitStatusExport($equipment), 'unit_status.xlsx');
    }
}
