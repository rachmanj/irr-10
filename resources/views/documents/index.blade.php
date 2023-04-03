@extends('templates.main')

@section('title_page')
    Documents
@endsection

@section('breadcrumb_title')
    document
@endsection

@section('content')
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <a href="{{ route('documents.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Document</a>
          </div> {{-- card-header --}}

          <div class="card-body">
            <table id="documents" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Doc. No</th>
                  <th>Date</th>
                  <th>Type</th>
                  <th>Unit No</th>
                  <th>Due Date</th>
                  <th>action</th>
                </tr>
              </thead>
            </table>
          </div> {{-- card-body --}}
        </div> {{-- card --}}
      </div>
    </div>
@endsection

@section('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/plugins/datatables/css/datatables.min.css') }}"/>
@endsection

@section('scripts')
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables/datatables.min.js') }}"></script>

  <script>
    $(function () {
      $("#documents").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('documents.index.data') }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'document_no'},
          {data: 'document_date'},
          {data: 'doctype'},
          {data: 'unit_no'},
          {data: 'due_date'},
          {data: 'action'},
        ],
        fixedHeader: true,
      })
    });
  </script>

@endsection