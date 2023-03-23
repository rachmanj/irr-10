@extends('templates.main')

@section('title_page')
    Unit Model
@endsection

@section('breadcrumb_title')
    unitmodel
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Create New Model</h3>
            <a href="{{ route('unitmodels.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-arrow-left"></i> Back</a>
          </div> {{-- card-header --}}

          <form action="{{ route('unitmodels.store') }}" method="POST">
            @csrf
            <div class="card-body">

              <div class="form-group">
                <label for="model_no">Model No</label>
                <input name="model_no" type="text" class="form-control @error('model_no') is-invalid @enderror" id="model_no" value="{{ old('model_no') }}" autofocus>
                @error('model_no')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label>Manufacture</label>
                <select name="manufacture_id" class="form-control select2bs4 @error('manufacture_id') is-invalid @enderror">
                  <option value="">-- select --</option>
                  @foreach ($manufactures as $manufacture)
                      <option value="{{ $manufacture->id }}">{{ $manufacture->name }}</option>
                  @endforeach
                </select>
                @error('manufacture_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label>Transmisi</label>
                <select name="transmisi" class="form-control select2bs4 @error('transmisi') is-invalid @enderror">
                  <option value="">-- select transmisi --</option>
                  <option value="AUTOMATIC">AUTOMATIC</option>
                  <option value="MANUAL">MANUAL</option>
                  <option value="MANUALDOUBLE">MANUAL DOUBLE</option>
                </select>
                @error('transmisi')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="description">Description</label>
                <input name="description" type="text" class="form-control @error('description') is-invalid @enderror" id="description" value="{{ old('description') }}">
                @error('description')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

            </div> {{-- card-body --}}
  
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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



