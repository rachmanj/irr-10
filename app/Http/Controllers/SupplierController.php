<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        return view('suppliers.index');
    }


    public function create()
    {
        return view('suppliers.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:suppliers,name',
        ]);

        Supplier::create(array_merge($validated, [
            'remarks' => $request->remarks
        ]));

        return redirect()->route('suppliers.index')->with('success', 'Data successfully added');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }


    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|unique:suppliers,name,' . $supplier->id,
        ]);

        $supplier->update(array_merge($validated, [
            'remarks' => $request->remarks
        ]));

        return redirect()->route('suppliers.index')->with('success', 'Data successfully updated');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Data successfully deleted');
    }

    public function data()
    {
        $suppliers = Supplier::orderBy('name', 'asc')->get();

        return datatables()->of($suppliers)
            ->addIndexColumn()
            ->addColumn('action', 'suppliers.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
