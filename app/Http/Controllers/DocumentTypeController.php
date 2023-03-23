<?php

namespace App\Http\Controllers;

use App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    public function index()
    {
        return view('doctypes.index');
    }

    public function create()
    {
        return view('doctypes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:document_types',
        ]);

        DocumentType::create($request->all());

        return redirect()->route('doctypes.index')
            ->with('success', 'Document Type created successfully.');
    }

    public function edit(DocumentType $doctype)
    {
        return view('doctypes.edit', compact('doctype'));
    }

    public function update(Request $request, DocumentType $doctype)
    {
        $request->validate([
            'name' => 'required|unique:document_types,name,' . $doctype->id . ',id',
        ]);

        $doctype->update($request->all());

        return redirect()->route('doctypes.index')
            ->with('success', 'Document Type updated successfully');
    }

    public function destroy(DocumentType $doctype)
    {
        $doctype->delete();

        return redirect()->route('doctypes.index')
            ->with('success', 'Document Type deleted successfully');
    }

    public function index_data()
    {
        $doctypes = DocumentType::orderBy('name', 'asc')->get();

        return datatables()->of($doctypes)
            ->addIndexColumn()
            ->addColumn('action', 'doctypes.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
