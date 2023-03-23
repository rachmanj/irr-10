@extends('templates.main')

@section('title_page')
    Equipments
@endsection

@section('breadcrumb_title')
    equipments
@endsection

@section('content')
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            @if (Session::has('success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('success') }}
              </div>
            @endif
            @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
              <a href="{{ route('equipments.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Equipment</a>
            @endif
          </div> {{-- card-header --}}

          <div class="card-body">
            <table id="equipments" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Unit No</th>
                  <th>Model</th>
                  <th>Manufacture</th>
                  <th>SN</th>
                  <th>Type</th>
                  <th>Location</th>
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
      $("#equipments").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('equipments.index.data') }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'unit_no'},
          {data: 'model'},
          {data: 'manufacture'},
          {data: 'serial_no'},
          {data: 'plant_type'},
          {data: 'current_project'},
          {data: 'action'},
        ],
        fixedHeader: true,
      })
    });
  </script>

@endsection