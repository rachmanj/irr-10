@extends('templates.main')

@section('title_page')
    IPA
@endsection

@section('breadcrumb_title')
    ipa
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Edit IPA</h3>
            <a href="{{ route('movings.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-undo"></i> Back</a>
          </div> {{-- card-header --}}

            <div class="card-body">

            <form action="{{ route('movings.update', $moving->id) }}" method="POST">
              @csrf @method('PUT')
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="ipa_no">IPA No</label>
                    <input name="ipa_no" value="{{ old('ipa_no', $moving->ipa_no) }}" type="text" class="form-control @error('ipa_no') is-invalid @enderror" id="ipa_no" autofocus>
                    @error('ipa_no')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="ipa_date">Date</label>
                    <input name="ipa_date" value="{{ old('ipa_date', $moving->ipa_date) }}" type="date" class="form-control @error('ipa_date') is-invalid @enderror" id="ipa_date">
                    @error('ipa_date')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="from_project_id">From Project</label>
                    <select name="from_project_id" class="form-control select2bs4 @error('from_project_id') is-invalid @enderror" disabled>
                      <option value="">-- select project --</option>
                      @foreach ($projects as $project)
                          <option {{ old('from_project_id') == $project->id || $moving->from_project_id == $project->id ? "selected" : "" }} value="{{ $project->id }}">{{ $project->project_code .' - '. $project->bowheer .' - '. $project->location  }}</option>
                      @endforeach
                    </select>
                    @error('from_project_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="to_project_id">To Project</label>
                    <select name="to_project_id" class="form-control select2bs4 @error('to_project_id') is-invalid @enderror" disabled>
                      <option value="">-- select project --</option>
                      @foreach ($projects as $project)
                          <option {{ old('to_project_id') == $project->id || $moving->to_project_id == $project->id ? "selected" : "" }} value="{{ $project->id }}">{{ $project->project_code .' - '. $project->bowheer .' - '. $project->location  }}</option>
                      @endforeach
                    </select>
                    @error('to_project_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div> {{-- row --}}

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="tujuan_row_1">Tujuan <small>(baris 1)</small></label>
                    <input name="tujuan_row_1" value="{{ old('tujuan_row_1', $moving->tujuan_row_1) }}" type="text" class="form-control" id="tujuan_row_1">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="tujuan_row_2">Tujuan <small>(baris 2)</small></label>
                    <input name="tujuan_row_2" value="{{ old('tujuan_row_2', $moving->tujuan_row_2) }}" type="text" class="form-control" id="tujuan_row_2">
                  </div>
                </div>
              </div> {{-- row --}}

              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label for="cc_row_1">CC <small>(baris 1)</small></label>
                    <input name="cc_row_1" value="{{ old('cc_row_1', $moving->cc_row_1) }}" type="text" class="form-control" id="cc_row_1">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="cc_row_2">CC <small>(baris 2)</small></label>
                    <input name="cc_row_2" value="{{ old('cc_row_2', $moving->cc_row_2) }}" type="text" class="form-control" id="cc_row_2">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="cc_row_3">CC <small>(baris 3)</small></label>
                    <input name="cc_row_3" value="{{ old('cc_row_3', $moving->cc_row_3) }}" type="text" class="form-control" id="cc_row_3">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <label for="remarks">Remarks</label>
                  <textarea name="remarks" id="remarks" class="form-control" rows="2">{{ old('remarks', $moving->remarks) }}</textarea>
                </div>
              </div> {{--  row --}}

              <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save & Back to List</button>
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



