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
            <h3 class="card-title">Edit Change Detail</h3>
            <a href="{{ route('unitnohistories.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-arrow-left"></i> Back</a>
          </div> {{-- card-header --}}

          <form action="{{ route('unitnohistories.update', $unitno_history->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="card-body">

              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label for="date">Date of Change</label>
                    <input name="date" value="{{ old('date', $unitno_history->date) }}" type="date" class="form-control" id="date" autofocus>
                  </div>
                </div>
                <div class="col-8">
                  <div class="form-group">
                    <label>Equipment</label>
                    <input type="text" value="{{ $unitno_history->equipment->unitmodel->model_no }}" class="form-control" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Old Unit Number</label>
                    <input type="text" name="old_unit_no" id="old_unit_no" value="{{ $unitno_history->old_unit_no }}" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>New Unit Number</label>
                    <input type="text" name="new_unit_no" id="new_unit_no" value="{{ $unitno_history->new_unit_no }}" class="form-control" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <textarea name="remarks" id="remarks" rows="2" class="form-control">{{ old('remarks', $unitno_history->remarks) }}</textarea>
                  </div>
                </div>
              </div> {{-- row --}}

            </div> {{-- card-body --}}
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
            </div>
          </f>

        </div> {{--  card --}}
      </div>
    </div>
@endsection

