<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\HazardReport;
use App\Models\PlantGroup;
use App\Models\PlantType;
use App\Models\Unitstatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'projects' => $this->getCurrentProjects(),
            'equipments' => $this->getEquipments(),
            'unit_status' => $this->getUnitStatus(),
            'plant_types' => $this->getPlantType(),
            'plant_groups' => $this->getPlantGroup(),
        ]);
    }

    public function getCurrentProjects()
    {
        $current_project_ids = DB::table('equipments')->distinct()
            ->orderBy('current_project_id', 'asc')
            ->pluck('current_project_id');

        $current_projects = DB::table('projects')->select('project_code', 'id')
            ->whereIn('id', $current_project_ids)
            ->orderBy('project_code', 'asc')
            ->get();

        return $current_projects;
    }

    public function getEquipments()
    {
        $equipments = Equipment::select(
            'current_project_id',
            'unitstatus_id',
            'plant_type_id',
            'plant_group_id'
        )->get();
        return $equipments;
    }

    public function getUnitStatus()
    {
        $unit_status = Unitstatus::select('id', 'name')->get();

        return $unit_status;
    }

    public function getPlantType()
    {
        $plant_type = PlantType::select('id', 'name')->get();

        return $plant_type;
    }

    public function getPlantGroup()
    {
        $plant_group = PlantGroup::select('id', 'name')->get();

        return $plant_group;
    }

    public function test()
    {
        $test = $this->getPlantType();

        return $test;
    }
}
