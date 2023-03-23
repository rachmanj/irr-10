<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Moving;
use App\Models\MovingDetail;
use App\Models\Unitstatus;
use Illuminate\Http\Request;

class MovingDetailController extends Controller
{
    public function create($moving_id)
    {
        $moving = Moving::find($moving_id);
        return view('movings.create_add_units', compact('moving'));
    }

    public function add_tocart($equipment_id)
    {
        $moving_flag = 'DRAFT' . auth()->id();
        $moving = Moving::where('flag', $moving_flag)->first();
        $moving_id = $moving->id;
        $equipment = Equipment::where('id', $equipment_id)->first();
        $equipment->cart_flag = 'MOVING' . auth()->id();
        $equipment->update();

        return redirect()->route('moving_details.create', $moving_id);
    }

    public function remove_fromcart()
    {
        $moving_flag = 'DRAFT' . auth()->id();
        $moving_id = Moving::where('flag', $moving_flag)->first()->id;
        $cart_flag = 'MOVING' . auth()->id();
        $equipment = Equipment::where('cart_flag', $cart_flag)->first();
        $equipment->cart_flag = null;
        $equipment->update();

        return redirect()->route('moving_details.create', $moving_id);
    }

    public function store(Request $request)
    {
        $moving_id = $request->moving_id;
        $moving = Moving::find($moving_id);
        $flag = 'MOVING' . auth()->id();
        $equipments = Equipment::where('cart_flag', $flag)->get();

        foreach ($equipments as $equipment) {
            MovingDetail::create([
                'moving_id' => $moving_id,
                'equipment_id' => $equipment->id
            ]);
        }

        // update current_project_id and reset cart_flag to null
        Equipment::where('cart_flag', $flag)->update([
            'cart_flag' => null,
            'current_project_id' => $moving->to_project_id
        ]);

        // update moving flag to null
        $moving->flag = null;
        $moving->update();

        return redirect()->route('movings.index');
    }

    public function available_unit_data($project_id)
    {
        $unit_active = Unitstatus::where('name', 'ACTIVE')->first()->id;

        $equipments = Equipment::where('current_project_id', $project_id)
            ->where('unitstatus_id', $unit_active)
            ->whereNull('cart_flag')
            ->orderBy('unit_no', 'asc')
            ->get();

        return datatables()->of($equipments)
            ->addColumn('model_no', function ($equipments) {
                return $equipments->unitmodel->model_no;
            })
            ->addColumn('manufacture', function ($equipments) {
                return $equipments->unitmodel->manufacture->name;
            })
            ->addIndexColumn()
            ->addColumn('action', 'movings.add_tocart')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function unit_incart_data()
    {
        $flag = 'MOVING' . auth()->id();

        $equipments = Equipment::where('cart_flag', $flag)
            ->orderBy('unit_no', 'asc')
            ->get();

        return datatables()->of($equipments)
            ->addColumn('model_no', function ($equipments) {
                return $equipments->unitmodel->model_no;
            })
            ->addColumn('manufacture', function ($equipments) {
                return $equipments->unitmodel->manufacture->name;
            })
            ->addIndexColumn()
            ->addColumn('action', 'movings.remove_fromcart')
            ->rawColumns(['action'])
            ->toJson();
    }
}
