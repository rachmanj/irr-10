<?php

namespace App\Http\Controllers;

use App\Models\PlantGroup;
use App\Models\PlantType;
use Illuminate\Http\Request;

class PlantGroupController extends Controller
{
    public function index()
    {
        return view('plant_groups.index');
    }

    public function create()
    {
        $plant_types = PlantType::orderBy('name')->get();
        return view('plant_groups.create', compact('plant_types'));
    }

    public function store(Request $request)
    {
        $data_tosave = $this->validate($request, [
            'plant_type_id' => 'required',
            'name' => 'required|unique:plant_groups'
        ]);

        PlantGroup::create($data_tosave);

        return redirect()->route('plant_groups.index')->with('success', 'New Plant Group successfully added');
    }

    public function edit(PlantGroup $plant_group)
    {
        $plant_types = PlantType::orderBy('name')->get();
        return view('plant_groups.edit', compact('plant_group', 'plant_types'));
    }

    public function update(Request $request, $id)
    {
        $data_tosave = $this->validate($request, [
            'plant_type_id' => ['required'],
            'name' => ['required', 'unique:plant_groups,name,' . $id]
        ]);

        $asset_group = PlantGroup::find($id);
        $asset_group->update($data_tosave);

        return redirect()->route('plant_groups.index')->with('success', 'Plant Group successfully updated');
    }

    public function destroy(PlantGroup $plantGroup)
    {
        $plantGroup->delete();
        return redirect()->route('plant_groups.index')->with('success', 'Plant Group successfully deleted');
    }

    public function get_plant_group_by_plant_type_id(Request $request)
    {
        if (!$request->plant_type_id) {
            $html = '<option value="">-- select plant group --</option>';
        } else {
            $html = '';
            $plant_groups = PlantGroup::where('plant_type_id', $request->plant_type_id)->get();
            foreach ($plant_groups as $plant_group) {
                $html .= '<option value="' . $plant_group->id . '">' . $plant_group->name . '</option>';
            }
        }

        return response()->json(['group_html' => $html]);
    }

    public function data()
    {
        $plant_groups = PlantGroup::orderBy('plant_type_id', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        return datatables()->of($plant_groups)
            ->addColumn('plant_type', function ($plant_groups) {
                return $plant_groups->plant_type->name;
            })
            ->addIndexColumn()
            ->addColumn('action', 'plant_groups.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
