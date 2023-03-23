<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ApiProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('isActive', 1)->orderBy('project_code', 'asc')->get();

        return ProjectResource::collection($projects);
    }
}
