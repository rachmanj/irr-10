<div class="row">
  <div class="col-6">
    <dl class="row">
      <dt class="col-sm-4">Unit No</dt>
      <dd class="col-sm-8">: {{ $equipment->unit_no }}</dd>
      <dt class="col-sm-4">Active Date</dt>
      <dd class="col-sm-8">: {{ $equipment->active_date ? date('d-M-Y', strtotime($equipment->active_date)) : ' -' }}</dd>
      <dt class="col-sm-4">Description</dt>
      <dd class="col-sm-8">: {{ $equipment->description }}</dd>
      <dt class="col-sm-4">Model</dt>
      <dd class="col-sm-8">: {{ $equipment->unitmodel->model_no . ' | ' . $equipment->unitmodel->description}}</dd>
      <dt class="col-sm-4">Manufacture</dt>
      <dd class="col-sm-8">: {{ $equipment->unitmodel->manufacture->name }}</dd>
      <dt class="col-sm-4">Plant Type</dt>
      <dd class="col-sm-8">: {{ $equipment->plant_type->name }}</dd>
      <dt class="col-sm-4">Asset Category</dt>
      <dd class="col-sm-8">: {{ $equipment->asset_category->name }}</dd>
      <dt class="col-sm-4">Current Location</dt>
      <dd class="col-sm-8">: {{ $equipment->current_project->project_code . ' - ' . $equipment->current_project->bowheer .', '. $equipment->current_project->location }}</dd>
      <dt class="col-sm-4">Status</dt>
      <dd class="col-sm-8">: {{ $equipment->unitstatus->name }}</dd>
    </dl>
  </div>
  <div class="col-6">
    <dl class="row">
      <dt class="col-sm-4">Serial No</dt>
      <dd class="col-sm-8">: {{ $equipment->serial_no }}</dd>
      {{-- <dt class="col-sm-4">Chasis No</dt>
      <dd class="col-sm-8">: {{ $equipment->chasis_no }}</dd> --}}
      <dt class="col-sm-4">Engine Model</dt>
      <dd class="col-sm-8">: {{ $equipment->engine_model}}</dd>
      <dt class="col-sm-4">Machine No</dt>
      <dd class="col-sm-8">: {{ $equipment->machine_no }}</dd>
      <dt class="col-sm-4">Nomor Polisi</dt>
      <dd class="col-sm-8">: {{ $equipment->nomor_polisi }}</dd>
      <dt class="col-sm-4">Body Color</dt>
      <dd class="col-sm-8">: {{ $equipment->warna }}</dd>
      <dt class="col-sm-4">Fuel Type</dt>
      <dd class="col-sm-8">: {{ $equipment->bahan_bakar }}</dd>
      <dt class="col-sm-4">Capacity</dt>
      <dd class="col-sm-8">: {{ $equipment->capacity }}</dd>
      <dt class="col-sm-4">Created by</dt>
      <dd class="col-sm-8">: {{ $equipment->creator->name }}</dd>
    </dl>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <label for="remarks">Remarks</label>
    <textarea name="remarks" rows="2" class="form-control">{{ $equipment->remarks }}</textarea>
  </div>
</div>