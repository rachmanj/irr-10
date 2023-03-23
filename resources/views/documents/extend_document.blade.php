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
            <h3 class="card-title">Extend Document of  {{ $document->document_type->name . ' No. ' .  $document->document_no }}</h3>
            <a href="{{ route('reports.document_with_overdue') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-undo"></i> Back</a>
          </div> {{-- card-header --}}

          <form action="{{ route('documents.extends_update', $document->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="card-body">

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Choose Document Extension</label>
                    <select name="extended_doc_id" id="extended_doc_id" class="form-control select2bs4 @error('extended_doc_id') is-invalid @enderror">
                      <option value="">-- select document --</option>
                      @foreach ($documents as $doc)
                          <option value="{{ $doc->id }}">{{ $doc->document_no .' - '. $doc->document_type->name}}</option>
                      @endforeach
                    </select>
                    @error('extended_doc_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
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



