<div class="card card-info">
    <div class="card-header border-transparent">
        <h3 class="card-title">Summary by Plant Group <small>(excl SOLD)</small></h3>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table m-0 table-striped">
                <thead>
                    <tr>
                        <th>Plant Group Name</th>
                        @foreach ($projects as $project)
                            <th class="text-right">{{ $project->project_code }}</th>
                        @endforeach
                        <th class="text-right">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plant_groups as $group)
                        <tr>
                            <td>
                                <strong>{{ $group->name }}</strong>
                            </td>
                            @foreach ($projects as $project)
                                <td class="text-right">
                                    {{ $equipments->where('current_project_id', $project->id)->where('plant_group_id', $group->id)->count() }}
                                </td>
                            @endforeach
                            <td class="text-right">
                                <strong>{{ $equipments->where('plant_group_id', $group->id)->count() }}</strong>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>
                            <strong>TOTAL</strong>
                        </td>
                        @foreach ($projects as $project)
                        <td class="text-right">
                            <strong>{{ $equipments->where('current_project_id', $project->id)->count() }}</strong>
                        </td>
                        @endforeach
                        <td class="text-right">
                            <strong>{{ $equipments->count() }}</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>