<table>
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>Created at</th>
            <th>Project</th>
            <th>To Department</th>
            <th>Created by</th>
            <th>Category</th>
            <th>Danger Types</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hazard_reports as $key => $hazard)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $hazard->nomor }}</td>
            <td>{{ $hazard->created_at ? date('d-M-Y H:i:s', strtotime($hazard->created_at->addHours(8))) : 'n/a' }}</td>
            <td>{{ $hazard->project_code }}</td>
            <td>{{ $hazard->to_department_id ? $hazard->department->department_name : 'n/a' }}</td>
            <td>{{ $hazard->created_by ? $hazard->employee->name : 'n/a' }}</td>
            <td>{{ $hazard->category }}</td>
            <td>@foreach ($hazard->danger_types as $item)
                {{ $item->name }},
                @endforeach
            </td>
            <td>{{ $hazard->description }}</td>
            <td>{{ $hazard->status }}</td>
        </tr>
        @endforeach
</table>