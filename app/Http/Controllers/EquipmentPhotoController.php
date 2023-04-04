<?php

namespace App\Http\Controllers;

use App\Models\EquipmentPhoto;
use Illuminate\Http\Request;

class EquipmentPhotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|integer',
            'filename' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $equipmentPhoto = new EquipmentPhoto();
        $equipmentPhoto->equipment_id = $request->equipment_id;
        $equipmentPhoto->filename = $request->filename;
        $equipmentPhoto->description = $request->description;
        $equipmentPhoto->created_by = auth()->user()->id;
        $equipmentPhoto->save();

        return response()->json($equipmentPhoto);
    }
}
