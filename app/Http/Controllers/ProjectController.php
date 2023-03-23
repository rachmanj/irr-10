<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index');
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_code' => 'required|unique:projects',
            'bowheer' => 'required',
            'location' => 'required',
        ]);

        Project::create(array_merge($validated, [
            'address' => $request->address,
            'city' => $request->city,
            'isActive' => 1,
            'created_by' => auth()->id()
        ]));

        return redirect()->route('projects.index')->with('success', 'Data successfully added');
    }

    public function edit($id)
    {
        $project = Project::find($id);

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'project_code' => 'required|unique:projects,project_code,' . $project->id . ',id',
            'bowheer' => 'required',
            'location' => 'required',
        ]);

        $project->update(array_merge($validated, [
            'address' => $request->address,
            'city' => $request->city,
            'isActive' => $request->isActive
        ]));

        return redirect()->route('projects.index')->with('success', 'Data successfully updated');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Data successfully deleted');
    }

    public function data()
    {
        $projects = Project::orderBy('project_code')->get();

        return datatables()->of($projects)
            ->editColumn('isActive', function ($projects) {
                return $projects->isActive == 1 ? '<span class="badge badge-success">active</span>' : '<span class="badge badge-danger">in-active</span>';
            })
            ->addIndexColumn()
            ->addColumn('action', 'projects.action')
            ->rawColumns(['action', 'isActive'])
            ->toJson();
    }
}
