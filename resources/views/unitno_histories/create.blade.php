@extends('templates.main')

@section('title_page')
    Unit Number Change
@endsection

@section('breadcrumb_title')
    unitnochange
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Create New Change</h3>
          </div> {{-- card-header --}}

          <form action="{{ route('unitnohistories.store') }}" method="POST">
            @csrf
            <div class="card-body">

              <div class="row">
                <div class="col-2">
                  <div class="form-group">
                    <label for="date">Date of Change</label>
                    <input name="date" value="{{ old('date') }}" type="date" class="form-control @error('date') is-invalid @enderror" id="date">
                    @error('date')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-5">
                  <div class="form-group">
                    <label>Old Unit Number</label>
                    <select name="equipment_id" id="equipment_id" class="form-control select2bs4 @error('equipment_id') is-invalid @enderror">
                      <option value="">-- select equipment --</option>
                      @foreach ($equipments as $equipment)
                          <option value="{{ $equipment->id }}" {{ old('equipment_id') ==  $equipment->id ? 'selected' : '' }}>{{ $equipment->unit_no .' - '. $equipment->unitmodel->model_no .' - '. $equipment->unitmodel->manufacture->name }}</option>
                      @endforeach
                    </select>
                    @error('equipment_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-5">
                  <div class="form-group">
                    <label>New Unit Number</label>
                    <input type="text" name="new_unit_no" id="new_unit_no" value="{{ old('new_unit_no') }}" class="form-control @error('new_unit_no') is-invalid @enderror">
                    @error('new_unit_no')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <textarea name="remarks" id="remarks" rows="2" class="form-control">{{ old('remarks') }}</textarea>
                  </div>
                </div>
              </div> {{-- row --}}

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