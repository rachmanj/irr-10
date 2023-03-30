<h3>Summary IPA</h3>
<h4>Month: {{ date('F Y', strtotime($date)) }}</h4>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>ipa_no</th>
            <th>ipa_date</th>
            <th>from_project</th>
            <th>to_project</th>
            <th>equipments</th>
        </tr>
    </thead>
    @foreach ($ipas as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->ipa_no }}</td>
            <td>{{ date('d-M-Y', strtotime($item->ipa_date)) }}</td>
            <td>{{ $item->from_project->project_code }}</td>
            <td>{{ $item->to_project->project_code }}</td>
            <td>
                @foreach ($item->moving_details as $detail)
                    {{ $detail->equipment->unit_no }},
                @endforeach                
            </td>
        </tr>
    @endforeach
</table>