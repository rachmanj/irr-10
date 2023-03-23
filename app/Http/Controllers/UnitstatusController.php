<?php

namespace App\Http\Controllers;

use App\Models\Unitstatus;
use Illuminate\Http\Request;

class UnitstatusController extends Controller
{
    public function index()
    {
        return view('unitstatuses.index');
    }

    public function create()
    {
        return view('unitstatuses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:unitstatuses,name',
        ]);

        Unitstatus::create($validated);
        return redirect()->route('unitstatuses.index')->with('success', 'Data succesfully added');
    }

    public function edit(Unitstatus $unitstatus)
    {
        return view('unitstatuses.edit', compact('unitstatus'));
    }

    public function update(Request $request, Unitstatus $unitstatus)
    {
        $validated = $request->validate([
            'name' => 'required|unique:unitstatuses,name,' . $unitstatus->id,
        ]);

        $unitstatus->update($validated);
        return redirect()->route('unitstatuses.index')->with('success', 'Data succesfully updated');
    }

    public function destroy(Unitstatus $unitstatus)
    {
        $unitstatus->delete();
        return redirect()->route('unitstatuses.index')->with('success', 'Data succesfully deleted');
    }

    public function data()
    {
        $unitstatuses = Unitstatus::orderBy('name', 'asc')->get();

        return datatables()->of($unitstatuses)
            ->addIndexColumn()
            ->addColumn('action', 'unitstatuses.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
