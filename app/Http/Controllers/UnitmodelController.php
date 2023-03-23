<?php

namespace App\Http\Controllers;

use App\Models\Manufacture;
use App\Models\Unitmodel;
use Illuminate\Http\Request;

class UnitmodelController extends Controller
{
    public function index()
    {
        return view('unitmodels.index');
    }

    public function create()
    {
        $manufactures = Manufacture::orderBy('name', 'asc')->get();

        return view('unitmodels.create', compact('manufactures'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'model_no' => ['required'],
            'manufacture_id' => ['required'],
            'transmisi' => ['required'],
            'description' => ['required'],
        ]);

        Unitmodel::create($validated);

        return redirect()->route('unitmodels.index')->with('success', 'Data successfully added');
    }

    public function show(Unitmodel $unitmodel)
    {
        //
    }

    public function edit(Unitmodel $unitmodel)
    {
        $manufactures = Manufacture::orderBy('name', 'asc')->get();

        return view('unitmodels.edit', compact('unitmodel', 'manufactures'));
    }

    public function update(Request $request, Unitmodel $unitmodel)
    {
        $validated = $request->validate([
            'model_no' => ['required'],
            'manufacture_id' => ['required'],
            'transmisi' => ['required'],
            'description' => ['required'],
        ]);
        $unitmodel->update($validated);

        return redirect()->route('unitmodels.index')->with('success', 'Data successfully updated');
    }

    public function destroy(Unitmodel $unitmodel)
    {
        $unitmodel->delete();
        return redirect()->route('unitmodels.index')->with('success', 'Data has been deleted');
    }

    public function data()
    {
        $unitmodels = Unitmodel::with('manufacture')->orderBy('model_no', 'asc')->get();

        return datatables()->of($unitmodels)
            ->editColumn('manufacture', function ($unitmodels) {
                return $unitmodels->manufacture->name;
            })
            ->addIndexColumn()
            ->addColumn('action', 'unitmodels.action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function get_model_detail(Request $request)
    {
        if (!$request->unitmodel_id) {
            $manufacture = '';
            $model_desc = '';
        } else {
            $manufacture = '';
            $model_desc = '';
            $model = Unitmodel::with('manufacture')->where('id', $request->unitmodel_id)->first();
            $manufacture .= $model->manufacture->name;
            $model_desc .= $model->description;
        }

        return response()->json(['manufacture' => $manufacture, 'model_desc' => $model_desc]);
    }
}
