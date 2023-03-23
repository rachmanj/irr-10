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
            <h5 class="card-title">Unit No : {{ $equipment->unit_no .' | '. $equipment->unitmodel->model_no .' | '. $equipment->unitmodel->manufacture->name }}</h5>
            <h3 class="card-title float-right">Edit Detail Data</h3>
          </div> {{-- card-header --}}

          <form action="{{ route('equipments.update_detail', $equipment->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="card-body">

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="serial_no">Serial/Chasis No</label>
                    <input type="hidden" name="unit_no" value="{{ $equipment->unit_no }}">
                    <input name="serial_no" type="text" value="{{ old('serial_no', $equipment->serial_no) }}" class="form-control" id="serial_no" autofocus>
                  </div>
                </div>
                {{-- <div class="col-4">
                  <div class="form-group">
                    <label for="chasis_no">Chasis No</label>
                    <input name="chasis_no" type="text" value="{{ old('chasis_no', $equipment->chasis_no) }}" class="form-control" id="chasis_no">
                  </div>
                </div> --}}
                <div class="col-6">
                  <div class="form-group">
                    <label for="machine_no">Machine No</label>
                    <input name="machine_no" type="text" value="{{ old('machine_no', $equipment->machine_no) }}" class="form-control" id="machine_no">
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label for="engine_model">Engine Model</label>
                    <input name="engine_model" type="text" value="{{ old('engine_model', $equipment->engine_model) }}" class="form-control" id="engine_model">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="nomor_polisi">Nomor Polisi</label>
                    <input name="nomor_polisi" type="text" value="{{ old('nomor_polisi', $equipment->nomor_polisi) }}" class="form-control" id="nomor_polisi">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="warna">Warna</label>
                    <input name="warna" type="text" value="{{ old('warna', $equipment->warna) }}" class="form-control" id="warna">
                  </div>
                </div>
              </div> {{-- row --}}

              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label for="bahan_bakar">Bahan Bakar</label>
                    <input name="bahan_bakar" type="text" value="{{ old('bahan_bakar', $equipment->bahan_bakar) }}" class="form-control" id="bahan_bakar">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="capacity">Capacity</label>
                    <input name="capacity" type="number" step="any" value="{{ old('capacity', $equipment->capacity) }}" class="form-control" id="bahan_bakar">
                  </div>
                </div>
              </div> {{-- row --}}
              <div class="row">
                <div class="col-12">
                  <label for="remarks">Remarks</label>
                  <textarea name="remarks" class="form-control" id="remarks" rows="2">{{ old('remarks', $equipment->remarks) }}</textarea>
                </div>
              </div> {{--  row --}}

            </div> {{-- card-body --}}
  
            <div class="card-footer">
              <a href="{{ route('equipments.index') }}" class="btn btn-sm btn-success"><i class="fas fa-undo"></i> Back</a>
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
    $(function () {
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    }) 
  </script>
@endsection



