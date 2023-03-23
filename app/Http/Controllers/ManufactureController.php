<?php

namespace App\Http\Controllers;

use App\Models\Manufacture;
use Illuminate\Http\Request;

class ManufactureController extends Controller
{
    public function index()
    {
        return view('manufactures.index');
    }

    public function create()
    {
        return view('manufactures.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:manufactures',
        ]);

        Manufacture::create($validated);

        return redirect()->route('manufactures.index')
            ->with('success', 'Manufacture created successfully.');
    }

    public function edit(Manufacture $manufacture)
    {
        return view('manufactures.edit', compact('manufacture'));
    }

    public function update(Request $request, Manufacture $manufacture)
    {
        $validated = $request->validate([
            'name' => 'required|unique:manufactures,name,' . $manufacture->id . ',id',
        ]);

        $manufacture->update($validated);

        return redirect()->route('manufactures.index')
            ->with('success', 'Manufacture updated successfully');
    }

    public function destroy(Manufacture $manufacture)
    {
        $manufacture->delete();

        return redirect()->route('manufactures.index')
            ->with('success', 'Manufacture deleted successfully');
    }

    public function data()
    {
        $manufactures = Manufacture::orderBy('name', 'asc')->get();

        return datatables()->of($manufactures)
            ->addColumn('action', 'manufactures.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->toJson();
    }
}
