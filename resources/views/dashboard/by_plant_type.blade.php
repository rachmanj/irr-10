<div class="card card-info">
    <div class="card-header border-transparent">
        <h3 class="card-title">Summary by Plant Types</h3>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table m-0 table-striped">
                <thead>
                    <tr>
                        <th>Projects</th>
                        @foreach ($plant_types as $type)
                            <th class="text-right">{{ $type->name }}</th>
                        @endforeach
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>
                                <strong>{{ $project->project_code }}</strong>
                            </td>
                            @foreach ($plant_types as $type)
                                <td class="text-right">
                                    {{ $equipments->where('current_project_id', $project->id)->where('plant_type_id', $type->id)->count() }}
                                </td>
                            @endforeach
                            <td class="text-right">
                                <strong>{{ $equipments->where('current_project_id', $project->id)->count() }}</strong>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>
                            <strong>Total</strong>
                        </td>
                        @foreach ($plant_types as $type)
                        <td class="text-right">
                            <strong>{{ $equipments->where('plant_type_id', $type->id)->count() }}</strong>
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