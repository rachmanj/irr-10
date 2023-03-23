@extends('templates.main')

@section('title_page')
    Documents
@endsection

@section('breadcrumb_title')
    documents
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Create New Document</h3>
          </div> {{-- card-header --}}

          <form action="{{ route('documents.store') }}" method="POST">
            @csrf
            <div class="card-body">

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="document_no">Document No</label>
                    <input name="document_no" value="{{ old('document_no') }}" type="text" class="form-control @error('document_no') is-invalid @enderror" id="document_no" autofocus>
                    @error('document_no')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Document Type</label>
                    <select name="document_type_id" id="document_type_id" class="form-control select2bs4 @error('document_type_id') is-invalid @enderror">
                      <option value="">-- select document type --</option>
                      @foreach ($doctypes as $doctype)
                          <option value="{{ $doctype->id }}" {{ old('document_type_id') == $doctype->id ? 'selected' : '' }}  >{{ $doctype->name }}</option>
                      @endforeach
                    </select>
                    @error('document_type_id')
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
                    <label for="document_date">Document Date</label>
                    <input name="document_date" value="{{ old('document_date') }}" type="date" class="form-control @error('document_date') is-invalid @enderror" id="document_date">
                    @error('document_date')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input name="due_date" value="{{ old('due_date') }}" type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date">
                    @error('due_date')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div> {{-- row --}}

              <div class="form-group">
                <label>Equipment</label>
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

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Vendor</label>
                    <select name="supplier_id" id="supplier_id" class="form-control select2bs4">
                      <option value="">-- select vendor --</option>
                      @foreach ($suppliers as $supplier)
                          <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="amount">Amount</label>
                    <input name="amount" type="number" class="form-control @error('amount') is-invalid @enderror" id="amount">
                    @error('amount')
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
                 <textarea name="remarks" class="form-control" id="remarks" rows="2">{{ old('remarks') }}</textarea>
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



