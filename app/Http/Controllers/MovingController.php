<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovingRequest;
use App\Models\Equipment;
use App\Models\Moving;
use App\Models\Project;
use App\Models\Unitstatus;
use Illuminate\Http\Request;

class MovingController extends Controller
{
    public function index()
    {
        return view('movings.index');
    }

    public function create()
    {

        $projects = Project::where('isActive', 1)->orderBy('project_code', 'asc')->get();

        return view('movings.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'ipa_date' => ['required'],
            'from_project_id' => ['required'],
            'to_project_id' => ['required'],
            'tujuan_row_1' => ['required'],
            'cc_row_1' => ['required'],
            'ipa_no' => ['required', 'unique:movings,ipa_no']
        ]);

        $moving_flag = 'DRAFT' . auth()->id();
        $moving = Moving::create(array_merge($request->validated(), [
            'ipa_no' => $request->ipa_no,
            'tujuan_row_2' => $request->tujuan_row_2,
            'cc_row_2' => $request->cc_row_2,
            'cc_row_3' => $request->cc_row_3,
            'remarks' => $request->remarks,
            'flag' => $moving_flag,
        ]));

        $moving_id = $moving->id;

        return redirect()->route('moving_details.create', $moving_id);
    }

    public function edit_before_select_equipment($moving_id)
    {
        $moving = Moving::find($moving_id);
        $projects = Project::where('isActive', 1)->orderBy('project_code', 'asc')->get();

        return view('movings.edit_before_equipment', compact('moving', 'projects'));
    }

    public function update_before_select_equipment(Request $request, $id)
    {
        $this->validate($request, [
            'ipa_date' => ['required'],
            'from_project_id' => ['required'],
            'to_project_id' => ['required'],
            'tujuan_row_1' => ['required'],
            'cc_row_1' => ['required'],
            'ipa_no' => ['required', 'unique:movings,ipa_no,' . $id]
        ]);

        $moving = Moving::find($id);
        $moving->update(array_merge($request->validated(), [
            'ipa_no' => $request->ipa_no,
            'tujuan_row_2' => $request->tujuan_row_2,
            'cc_row_2' => $request->cc_row_2,
            'cc_row_3' => $request->cc_row_3,
            'remarks' => $request->remarks,
        ]));

        return redirect()->route('moving_details.create', $id);
    }

    public function print_pdf($id)
    {
        $moving = Moving::with('moving_details.equipment')->where('id', $id)->first();

        return view('movings.print_pdf', compact('moving'));
    }

    public function print2_pdf($id)
    {
        $moving = Moving::with('moving_details.equipment')->where('id', $id)->first();

        return view('movings.print2_pdf', compact('moving'));
    }

    public function edit(Moving $moving)
    {
        $projects = Project::where('isActive', 1)->orderBy('project_code', 'asc')->get();

        return view('movings.edit', compact('moving', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'ipa_date' => ['required'],
            'from_project_id' => ['required'],
            'to_project_id' => ['required'],
            'tujuan_row_1' => ['required'],
            'cc_row_1' => ['required'],
            'ipa_no' => ['required', 'unique:movings,ipa_no,' . $id]
        ]);

        $moving = Moving::find($id);
        $moving->update(array_merge($request->validated(), [
            'ipa_no' => $request->ipa_no,
            'tujuan_row_2' => $request->tujuan_row_2,
            'cc_row_2' => $request->cc_row_2,
            'cc_row_3' => $request->cc_row_3,
            'remarks' => $request->remarks,
        ]));

        return redirect()->route('movings.index')->with('success', 'Data successfully updated');
    }

    public function destroy(Moving $moving)
    {
        $moving->delete();
        return redirect()->route('movings.index')->with('success', 'IPA successfully deleted');
    }

    public function index_data()
    {
        $movings = Moving::with('creator')->orderBy('ipa_date', 'desc')
            ->orderBy('ipa_no', 'desc')
            ->get();

        // return $movings;

        return datatables()->of($movings)
            ->editColumn('ipa_date', function ($movings) {
                return date('d-M-Y', strtotime($movings->ipa_date));
            })
            ->editColumn('from_project', function ($movings) {
                return $movings->from_project->project_code;
            })
            ->editColumn('to_project', function ($movings) {
                return $movings->to_project->project_code;
            })
            ->editColumn('created_by', function ($movings) {
                return $movings->creator->name;
            })
            ->addIndexColumn()
            ->addColumn('action', 'movings.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
