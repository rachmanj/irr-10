<?php

namespace App\Http\Controllers;

use App\Models\AssetCategory;
use Illuminate\Http\Request;

class AssetCategoryController extends Controller
{
    public function index()
    {
        return view('asset_categories.index');
    }

    public function create()
    {
        return view('asset_categories.create');
    }

    public function store(Request $request)
    {
        $data_tosave = $this->validate($request, [
            'name' => ['required', 'unique:asset_categories,name']
        ]);
        AssetCategory::create($data_tosave);
        return redirect()->route('asset_categories.index')->with('success', 'Data succesfully added');
    }

    public function edit(AssetCategory $asset_category)
    {
        return view('asset_categories.edit', compact('asset_category'));
    }

    public function update(Request $request, $id)
    {
        $data_tosave = $this->validate($request, [
            'name' => ['required', 'unique:asset_categories,name,' . $id]
        ]);
        $asset_category = AssetCategory::find($id);
        $asset_category->update($data_tosave);

        return redirect()->route('asset_categories.index')->with('success', 'Data succesfully updated');
    }

    public function destroy(AssetCategory $asset_category)
    {
        $asset_category->delete();
        return redirect()->route('asset_categories.index')->with('success', 'Data succesfully deleted');
    }

    public function index_data()
    {
        $asset_categories = AssetCategory::orderBy('name', 'asc')->get();

        return datatables()->of($asset_categories)
            ->addIndexColumn()
            ->addColumn('action', 'asset_categories.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
