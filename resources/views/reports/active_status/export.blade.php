<h3>Equipments with Status Active / In-Active by Projects</h3>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>CurrProject</th>
            <th>Status</th>
            <th>UnitNo</th>
            <th>ActiveDate</th>
            <th>Desc</th>
            <th>AssetCategory</th>
            <th>PlantType</th>
            <th>PlantGroup</th>
            <th>SN</th>
            <th>ChasisNo</th>
            <th>EngModel</th>
            <th>MachineNo</th>
            <th>NoPol</th>
            <th>FuelType</th>
            <th>Color</th>
            <th>PIC</th>
            <th>CartFlag</th>
            <th>Capacity</th>
            <th>AssignTo</th>
            <th>CreatedBy</th>
            <th>CreatedAt</th>
            <th>UpdatedBy</th>
            <th>UpdatedAt</th>
          </tr>
    </thead>
    @foreach ($equipments as $equipment)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $equipment->current_project->project_code }}</td>
          <td>{{ $equipment->unitstatus->name }}</td>
          <td>{{ $equipment->unit_no }}</td>
          <td>{{ $equipment->active_date ? date('d-M-Y', strtotime($equipment->active_date)) : 'n/a' }}</td>
          <td>{{ $equipment->description }}</td>
          <td>{{ $equipment->asset_category->name }}</td>
          <td>{{ $equipment->plant_type->name }}</td>
          <td>{{ $equipment->plant_group->name }}</td>
          <td>{{ $equipment->serial_no }}</td>
          <td>{{ $equipment->chasis_no }}</td>
          <td>{{ $equipment->engine_model }}</td>
          <td>{{ $equipment->machine_no }}</td>
          <td>{{ $equipment->nomor_polisi }}</td>
          <td>{{ $equipment->bahan_bakar }}</td>
          <td>{{ $equipment->warna }}</td>
          <td>{{ $equipment->unit_pic }}</td>
          <td>{{ $equipment->cart_flag }}</td>
          <td>{{ $equipment->capacity }}</td>
          <td>{{ $equipment->assign_to }}</td>
          <td>{{ $equipment->creator->name }}</td>
          <td>{{ $equipment->created_at ? date('d-M-Y H:i:s', strtotime($equipment->created_at)) : 'Uploaded'  }}</td>
          <td>{{ $equipment->updater->name }}</td>
          <td>{{ $equipment->updated_at ? date('d-M-Y H:i:s', strtotime($equipment->updated_at)) : 'n/a' }}</td>
        </tr>
    @endforeach
</table>