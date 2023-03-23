<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Equipment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function document_with_overdue()
    {
        return view('reports.overdue_docs.index');
    }

    public function report1_create()
    {
        $report_name = 'Equipment activation by Month';
        return view('reports.report1.create', compact('report_name'));
    }

    public function report1_display(Request $request)
    {
        $report_name = 'Equipment activation by Month';
        $date = $request->date;
        $month = substr($date, 5, 2);
        $year = substr($date, 0, 4);

        $equipments = Equipment::with('current_project', 'unitmodel')->whereMonth('active_date', $month)
            ->whereYear('active_date', $year)
            ->get();

        return view('reports.report1.display', compact('date', 'report_name', 'equipments'));
    }


    // DATA //

    public function document_with_overdue_data()
    {
        $date = Carbon::now()->addMonths(2);
        $list = Document::with('document_type', 'equipment')
            ->whereNotNull('due_date')
            ->where('due_date', '<=', $date)
            ->whereNull('extended_doc_id')
            ->get();

        return datatables()->of($list)
            ->addColumn('overdue_in', function ($list) {
                $date   = Carbon::parse($list->due_date);
                return $date->diffForHumans();
            })
            ->addColumn('unit_no', function ($list) {
                return $list->equipment->unit_no;
            })
            ->addColumn('doctype', function ($list) {
                return $list->document_type->name;
            })
            ->editColumn('due_date', function ($list) {
                return date('d-M-Y', strtotime($list->due_date));
            })
            ->addIndexColumn()
            ->addColumn('action', 'reports.overdue_docs.action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function report1_data($date)
    {
        $list = Equipment::whereMonth('active_date', $date)
            ->whereYear('active_date', $date)
            ->get();

        return datatables()->of($list)
            ->addIndexColumn()
            ->addColumn('action', 'reports.report1.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
