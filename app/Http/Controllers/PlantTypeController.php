<?php

namespace App\Http\Controllers;

use App\Models\PlantType;
use Illuminate\Http\Request;

class PlantTypeController extends Controller
{
    public function index()
    {
        return view('planttypes.index');
    }

    public function create()
    {
        return view('planttypes.create');
    }

    public function store(Request $request)
    {
        $data_tosave = $this->validate($request, [
            'name' => ['required', 'unique:plant_types,name']
        ]);

        PlantType::create($data_tosave);

        return redirect()->route('planttypes.index')->with('success', 'Data succesfully added');
    }

    public function edit(PlantType $planttype)
    {
        return view('planttypes.edit', compact('planttype'));
    }

    public function update(Request $request, $id)
    {
        $data_tosave = $this->validate($request, [
            'name' => ['required', 'unique:plant_types,name,' . $id]
        ]);

        $planttype = PlantType::find($id);
        $planttype->update($data_tosave);

        return redirect()->route('planttypes.index')->with('success', 'Data succesfully updated');
    }

    public function destroy(PlantType $planttype)
    {
        $planttype->delete();
        return redirect()->route('planttypes.index')->with('success', 'Data succesfully deleted');
    }

    public function data()
    {
        $planttypes = PlantType::orderBy('name', 'asc')->get();

        return datatables()->of($planttypes)
            ->addIndexColumn()
            ->addColumn('action', 'planttypes.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
