@extends('templates.main')

@section('title_page')
    Equipments
@endsection

@section('breadcrumb_title')
<a href="{{ route('equipments.index') }}">equipments</a>
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Create New Equipment</h3>
            <a href="{{ route('equipments.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-undo"></i> Back</a>
          </div> {{-- card-header --}}

          <form action="{{ route('equipments.store') }}" method="POST">
            @csrf
            <div class="card-body">

              <div class="row">
                <div class="col-3">
                  <div class="form-group">
                    <label for="unit_no">Unit No</label>
                    <input name="unit_no" type="text" value="{{ old('unit_no') }}" class="form-control @error('unit_no') is-invalid @enderror" id="unit_no" autofocus>
                    @error('unit_no')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label for="active_date">Active Date</label>
                    <input name="active_date" type="date" value="{{ old('active_date') }}" class="form-control @error('active_date') is-invalid @enderror" id="active_date">
                    @error('active_date')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-7">
                  <div class="form-group">
                    <label for="description">Description</label>
                    <input name="description" type="text" value="{{ old('description') }}" class="form-control @error('description') is-invalid @enderror" id="description" autofocus>
                    @error('description')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label>Model</label>
                    <select name="unitmodel_id" id="unitmodel_id" class="form-control select2bs4 @error('unitmodel_id') is-invalid @enderror">
                      <option value="">-- select unit model --</option>
                      @foreach ($unitmodels as $unitmodel)
                          <option value="{{ $unitmodel->id }}">{{ $unitmodel->model_no . ' - ' . $unitmodel->manufacture->name }}</option>
                      @endforeach
                    </select>
                    @error('unitmodel_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
  
                <div class="col-4">
                  <div class="form-group">
                    <label for="">Manufacture</label>
                    <input type="text" id="manufacture" class="form-control" readonly>
                  </div>
                </div>
  
                <div class="col-4">
                  <div class="form-group">
                    <label for="">Model Desc</label>
                    <input type="text" id="model_desc" class="form-control" readonly>
                  </div>
                </div>
              </div> {{-- row --}}

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Plant Type</label>
                    <select name="plant_type_id" id="plant_type_id" class="form-control select2bs4 @error('plant_type_id') is-invalid @enderror">
                      <option value="">-- select plant type --</option>
                      @foreach ($plant_types as $plant_type)
                          <option value="{{ $plant_type->id }}">{{ $plant_type->name }}</option>
                      @endforeach
                    </select>
                    @error('plant_type_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Plant Group</label>
                    <select name="plant_group_id" id="plant_group_id" class="form-control select2bs4 @error('plant_group_id') is-invalid @enderror">
                    </select>
                    @error('plant_group_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label>Current Project</label>
                    <select name="current_project_id" class="form-control select2bs4 @error('current_project_id') is-invalid @enderror">
                      <option value="">-- select current project --</option>
                      @foreach ($projects as $project)
                          <option value="{{ $project->id }}">{{ $project->project_code . ' - ' . $project->location }}</option>
                      @endforeach
                    </select>
                    @error('current_project_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                
                <div class="col-4">
                  <div class="form-group">
                    <label>Asset Category</label>
                    <select name="asset_category_id" class="form-control select2bs4 @error('category_id') is-invalid @enderror">
                      <option value="">-- select asset category --</option>
                      @foreach ($asset_categories as $asset_category)
                          <option value="{{ $asset_category->id }}">{{ $asset_category->name }}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label>Status</label>
                    <select name="unitstatus_id" class="form-control select2bs4 @error('unitstatus_id') is-invalid @enderror">
                      <option value="">-- select status --</option>
                      @foreach ($unitstatuses as $unitstatus)
                          <option value="{{ $unitstatus->id }}">{{ $unitstatus->name }}</option>
                      @endforeach
                    </select>
                    @error('unitstatus_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>

              </div> {{-- row --}}

            </div> {{-- card-body --}}
  
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
            </div>
          </form>

        </div> {{--  card --}}
      </div>
    </div>
@endsection

@section('styles')
    <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('scripts')
    <!-- Select2 -->
  <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
  <script>
    $("#unitmodel_id").change(function() {
      $.ajax({
        url: "{{ route('get_model_detail') }}?unitmodel_id=" + $(this).val(),
        method: 'GET',
        success: function(data) {
          $('#manufacture').val(data.manufacture);
          $('#model_desc').val(data.model_desc);
        }
      });
    });
    $("#plant_type_id").change(function() {
      $.ajax({
        url: "{{ route('get_plant_groups') }}?plant_type_id=" + $(this).val(),
        method: 'GET',
        success: function(data) {
          $('#plant_group_id').html(data.group_html);
        }
      });
    });
  </script>
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    }) 
  </script>
@endsection








