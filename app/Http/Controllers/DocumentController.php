<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Equipment;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        return view('documents.index');
    }

    public function create()
    {
        $equipments = Equipment::orderBy('unit_no', 'asc')->get();
        $doctypes = DocumentType::orderby('name', 'asc')->get();
        $suppliers = Supplier::orderBy('name', 'asc')->get();

        return view('documents.create', compact('equipments', 'doctypes', 'suppliers'));
    }

    public function store(StoreDocumentRequest $request)
    {
        if ($request->due_date) {
            $extended_status = 'REMAINDME';
        } else {
            $extended_status = null;
        }

        Document::create(array_merge($request->validated(), [
            'due_date' => $request->due_date,
            'supplier_id' => $request->supplier_id,
            'amount' => $request->amount,
            'remarks' => $request->remarks,
            'extended_status' => $extended_status,
            'user_id' => auth()->id()
        ]));
        return redirect()->route('documents.index')->with('success', 'Data succesfully added');
    }

    public function edit(Document $document)
    {
        $equipments = Equipment::with('unitmodel')->orderBy('unit_no', 'asc')->get();
        $doctypes = DocumentType::orderby('name', 'asc')->get();
        $suppliers = Supplier::orderBy('name', 'asc')->get();

        return view('documents.edit', compact('document', 'equipments', 'doctypes', 'suppliers'));
    }

    public function update(StoreDocumentRequest $request, Document $document)
    {
        $document->update(array_merge($request->validated(), [
            'due_date' => $request->due_date,
            'supplier_id' => $request->supplier_id,
            'amount' => $request->amount,
            'remarks' => $request->remarks,
        ]));;
        return redirect()->route('documents.index')->with('success', 'Data succesfully updated');
    }

    public function destroy(Document $document)
    {
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Data succesfully deleted');
    }

    public function extends_edit($id)
    {
        $document = Document::find($id);
        $equipment_id = $document->equipment_id;
        $document_type_id = $document->document_type_id;
        $documents = Document::where('equipment_id', $equipment_id)
            ->where('id', '!=', $id)
            ->where('document_type_id', $document_type_id)
            ->whereNotNull('due_date')
            ->whereNull('extended_doc_id')
            ->get();

        return view('documents.extend_document', compact('document', 'documents'));
    }

    public function extends_update(Request $request, $id)
    {
        $document = Document::find($id);
        $document->update([
            'extended_doc_id' => $request->extended_doc_id,
        ]);

        return redirect()->route('reports.document_with_overdue')->with('success', 'Data succesfully updated');
    }

    public function index_data()
    {
        $documents = Document::with('document_type')->latest()->get();

        return datatables()->of($documents)
            ->editColumn('document_date', function ($documents) {
                return date('d-M-Y', strtotime($documents->document_date));
            })
            ->editColumn('due_date', function ($documents) {
                if (!$documents->due_date) {
                    return '-';
                } else {
                    return date('d-M-Y', strtotime($documents->due_date));
                }
            })
            ->addColumn('doctype', function ($documents) {
                return $documents->document_type->name;
            })
            ->addColumn('unit_no', function ($documents) {
                return $documents->equipment->unit_no;
            })
            ->addIndexColumn()
            ->addColumn('action', 'documents.action')
            ->rawColumns(['action'])
            ->toJson();
    }
}
