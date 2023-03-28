<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentRequest;
use App\Models\AssetCategory;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Equipment;
use App\Models\PlantType;
use App\Models\Project;
use App\Models\Unitmodel;
use App\Models\UnitnoHistory;
use App\Models\Unitstatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\EquipmentsExport;
use Maatwebsite\Excel\Facades\Excel;

class EquipmentController extends Controller
{
    public function index()
    {
        return view('equipments.index');
    }

    public function create()
    {
        $projects   = Project::where('isActive', 1)->orderBy('project_code', 'asc')->get();
        $unitmodels = Unitmodel::with('manufacture')->orderBy('model_no', 'asc')->get();
        $plant_types = PlantType::orderby('name', 'asc')->get();
        $asset_categories = AssetCategory::orderBy('name')->get();
        $unitstatuses   = Unitstatus::orderBy('name')->get();

        return view('equipments.create', compact('projects', 'unitmodels', 'plant_types', 'asset_categories', 'unitstatuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit_no'   => ['required', 'unique:equipments,unit_no'],
            'active_date' => ['required'],
            'description' => ['required'],
            'unitmodel_id' => ['required'],
            'plant_type_id' => ['required'],
            'asset_category_id' => ['required'],
            'unitstatus_id' => ['required'],
            'current_project_id' => ['required'],
        ]);

        $equipment = Equipment::create(array_merge($validated, [
            'plant_group_id' => $request->plant_group_id,
            'created_by' => auth()->user()->id,
        ]));

        // save activity
        $activity = app(ActivityController::class);
        $activity->store(auth()->user()->id, 'create', 'Equipment', $equipment->id);

        return redirect()->route('equipments.index')->with('success', 'Data successfully added');
    }

    public function show($id)
    {
        $equipment = Equipment::with('unitmodel.manufacture')->where('id', $id)->first();

        return view('equipments.show', compact('equipment'));
    }

    public function edit(Equipment $equipment)
    {
        $projects   = Project::orderBy('project_code', 'asc')->get();
        $unitmodels = Unitmodel::with('manufacture')->orderBy('model_no', 'asc')->get();
        $plant_types = PlantType::orderby('name', 'asc')->get();
        $asset_categories = AssetCategory::orderBy('name')->get();
        $unitstatuses   = Unitstatus::orderBy('name')->get();

        return view('equipments.edit', compact('equipment', 'projects', 'unitmodels', 'plant_types', 'asset_categories', 'unitstatuses'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'unit_no'   => ['required', 'unique:equipments,unit_no,' . $id],
            'active_date' => ['required'],
            'description' => ['required'],
            'unitmodel_id' => ['required'],
            'plant_type_id' => ['required'],
            'asset_category_id' => ['required'],
            'unitstatus_id' => ['required'],
            'current_project_id' => ['required'],
        ]);

        $equipment = Equipment::find($id);

        $equipment->update(array_merge($validated, [
            'plant_group_id' => $request->plant_group_id,
            'updated_by' => auth()->user()->id,
        ]));

        // save activity
        $activity = app(ActivityController::class);
        $activity->store(auth()->user()->id, 'update', 'Equipment', $equipment->id);

        return redirect()->route('equipments.index')->with('success', 'Data successfully updated');
    }

    public function edit_detail(Equipment $equipment)
    {
        return view('equipments.edit_detail', compact('equipment'));
    }

    public function update_detail(Request $request, $id)
    {
        $equipment = Equipment::find($id);

        $equipment->update([
            'unit_no'       => $request->unit_no,
            'serial_no'     => $request->serial_no,
            'chasis_no'     => $request->chasis_no,
            'machine_no'    => $request->machine_no,
            'nomor_polisi'  => $request->nomor_polisi,
            'warna'         => $request->warna,
            'engine_model'  => $request->engine_model,
            'bahan_bakar'   => $request->bahan_bakar,
            'remarks'       => $request->remarks,
        ]);

        // save activity
        $activity = app(ActivityController::class);
        $activity->store(auth()->user()->id, 'update', 'Equipment', $equipment->id);

        return redirect()->route('equipments.index')->with('success', 'Data successfully updated');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('equipments.index')->with('success', 'Data successfully deleted');
    }

    public function index_data()
    {
        $equipments = Equipment::with('unitmodel.manufacture', 'current_project', 'plant_type')
            ->orderBy('unit_no', 'asc')->get();

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
            ->addIndexColumn()
            ->addColumn('action', 'equipments.action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function equipment_movings_data($id)
    {
        $movings = DB::table('movings')
            ->join('moving_details', 'movings.id', '=', 'moving_details.moving_id')
            ->join('projects as p1', 'movings.from_project_id', '=', 'p1.id')
            ->join('projects as p2', 'movings.to_project_id', '=', 'p2.id')
            ->select(
                'movings.ipa_no',
                'movings.ipa_date',
                'moving_details.equipment_id as equipment_id',
                'p1.project_code as from_project',
                'p2.project_code as to_project',
            )
            ->where('equipment_id', $id)
            ->orderBy('ipa_date', 'desc')
            ->get();

        return datatables()->of($movings)
            ->editColumn('ipa_date', function ($movings) {
                return date('d-M-Y', strtotime($movings->ipa_date));
            })
            ->addIndexColumn()
            ->toJson();
    }

    public function equipment_legals_data($id)
    {
        $docs_include_name = ['BPKB', 'STNK']; // document type : BPKB dan STNK
        foreach ($docs_include_name as $n) { // mencari ID dari dokumen2 exclude
            $docs_include_id_arr[] = DocumentType::where('name', $n)->first()->id;
        }

        $documents = Document::with('document_type')->where('equipment_id', $id)
            ->whereIn('document_type_id', $docs_include_id_arr)
            ->orderBy('document_date', 'desc')
            ->get();

        return datatables()->of($documents)
            ->editColumn('document_date', function ($documents) {
                return date('d-M-Y', strtotime($documents->document_date));
            })
            ->editColumn('due_date', function ($documents) {
                return date('d-M-Y', strtotime($documents->due_date));
            })
            ->addColumn('doctype', function ($documents) {
                return $documents->document_type->name;
            })
            ->addColumn('amount', function ($documents) {
                return number_format($documents->amount, 0);
            })
            ->addIndexColumn()
            ->addColumn('action', 'equipments.tabs.legals_action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function equipment_acquisitions_data($id)
    {
        $po_doctype = DocumentType::where('name', 'Purchase Order')->first();
        // $op_doctype = DocumentType::where('name', 'Other Payment')->first();

        $documents = Document::with('document_type')->where('equipment_id', $id)
            ->where('document_type_id', $po_doctype->id)
            // ->orWhere('document_type_id', $op_doctype->id)
            ->orderBy('document_date', 'desc')
            ->get();

        return datatables()->of($documents)
            ->editColumn('document_date', function ($documents) {
                return date('d-M-Y', strtotime($documents->document_date));
            })
            ->editColumn('due_date', function ($documents) {
                return date('d-M-Y', strtotime($documents->due_date));
            })
            ->addColumn('doctype', function ($documents) {
                return $documents->document_type->name;
            })
            ->addColumn('amount', function ($documents) {
                return number_format($documents->amount, 0);
            })
            ->addIndexColumn()
            ->addColumn('action', 'equipments.tabs.legals_action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function equipment_insurance_data($id)
    {
        $document_type = DocumentType::where('name', 'Polis Asuransi')->first();

        $documents = Document::with('document_type')->where('equipment_id', $id)
            ->where('document_type_id', $document_type->id)
            ->orderBy('document_date', 'desc')
            ->get();

        return datatables()->of($documents)
            ->editColumn('document_date', function ($documents) {
                return date('d-M-Y', strtotime($documents->document_date));
            })
            ->editColumn('due_date', function ($documents) {
                return date('d-M-Y', strtotime($documents->due_date));
            })
            ->addColumn('supplier', function ($documents) {
                return $documents->supplier->name;
            })
            ->addColumn('premi', function ($documents) {
                return number_format($documents->amount, 0);
            })
            ->addIndexColumn()
            ->addColumn('action', 'equipments.tabs.legals_action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function equipment_others_data($id)
    {
        $docs_exclude_name = [  // jenis dokumen selain yg disebutkan di sini
            'BPKB',
            'STNK',
            'Polis Asuransi',
            'Purchase Order',
        ];
        foreach ($docs_exclude_name as $n) { // mencari ID dari dokumen2 exclude
            $docs_exclude_id_arr[] = DocumentType::where('name', $n)->first()->id;
        }

        foreach ($docs_exclude_id_arr as $e) {
            $docs_exclude_arr[] = ['document_type_id', 'not like', $e];
        };

        $documents = Document::with('document_type')->where('equipment_id', $id)
            ->where($docs_exclude_arr)
            ->orderBy('document_date', 'desc')
            ->get();

        return datatables()->of($documents)
            ->editColumn('document_date', function ($documents) {
                return date('d-M-Y', strtotime($documents->document_date));
            })
            ->editColumn('due_date', function ($documents) {
                if ($documents->due_date) {
                    return  date('d-M-Y', strtotime($documents->due_date));
                } else {
                    return null;
                }
            })
            ->addColumn('doctype', function ($documents) {
                return $documents->document_type->name;
            })
            ->addColumn('supplier', function ($documents) {
                return $documents->supplier->name;
            })
            ->addColumn('amount', function ($documents) {
                return number_format($documents->amount, 0);
            })
            ->addIndexColumn()
            ->addColumn('action', 'equipments.tabs.legals_action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function equipment_changes_data($id)
    {
        $histories = UnitnoHistory::where('equipment_id', $id)->orderBy('date', 'desc')->get();

        return datatables()->of($histories)
            ->editColumn('date', function ($histories) {
                return date('d-M-Y', strtotime($histories->date));
            })
            ->addIndexColumn()
            ->toJson();
    }

    public function equipment_export_excel()
    {
        return Excel::download(new EquipmentsExport(), 'equipments_export.xlsx');
    }
}
