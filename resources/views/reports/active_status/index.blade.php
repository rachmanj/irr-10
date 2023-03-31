@extends('templates.main')

@section('title_page')
    Reports
@endsection

@section('breadcrumb_title')
    reports
@endsection

@section('content')
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Unit active/in-active by Project</h3>
            <a href="{{ route('reports.index') }}" class="btn btn-sm btn-primary mx-2 float-right"><i class="fas fa-arrow-left"></i> Back</a>
            <a href="{{ route('reports.active_status.export') }}" class="btn btn-sm btn-warning float-right"><i class="fas fa-excel"></i> Export to Excel</a>
          </div> {{-- card-header --}}

          <div class="card-body">
            <table id="active" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Location</th>
                  <th>Status</th>
                  <th>Unit No</th>
                  <th>Model</th>
                  <th>Manufacture</th>
                  <th>SN</th>
                  <th>Type</th>
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
      $("#active").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('reports.active_status.data') }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'current_project'},
          {data: 'status'},
          {data: 'unit_no'},
          {data: 'model'},
          {data: 'manufacture'},
          {data: 'serial_no'},
          {data: 'plant_type'},
        ],
        fixedHeader: true,
      })
    });
  </script>

@endsection
