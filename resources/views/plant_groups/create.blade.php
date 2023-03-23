@extends('templates.main')

@section('title_page')
    Plant Groups
@endsection

@section('breadcrumb_title')
    plantgroups
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Create New Plant Group</h3>
            <a href="{{ route('plant_groups.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-arrow-left"></i> Back</a>
          </div> {{-- card-header --}}

          <form action="{{ route('plant_groups.store') }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="col-6">
                <div class="form-group">
                  <label>Plant Type</label>
                  <select name="plant_type_id" id="plant_type_id" class="form-control select2bs4 @error('plant_type_id') is-invalid @enderror" autofocus>
                    <option value="">-- select plant type --</option>
                    @foreach ($plant_types as $plant_type)
                        <option value="{{ $plant_type->id }}" {{ old('plant_type_id') ==  $plant_type->id ? 'selected' : '' }}>{{ $plant_type->name }}</option>
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
                  <label for="name">Name</label>
                  <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name">
                  @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div> {{-- card-body --}}
  
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i>  Save</button>
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
    $(function () {
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    }) 
  </script>
@endsection



