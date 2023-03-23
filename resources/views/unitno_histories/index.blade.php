@extends('templates.main')

@section('title_page')
    Unit Number Change Histories
@endsection

@section('breadcrumb_title')
    unitno_histories
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
            <a href="{{ route('unitnohistories.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Change Unit No</a>
          </div> {{-- card-header --}}

          <div class="card-body">
            <table id="unitmodels" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Date Change</th>
                  <th>Equipment</th>
                  <th>Old No</th>
                  <th>New No</th>
                  <th>Creator</th>
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
      $("#unitmodels").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('unitno_histories.index.data') }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'date'},
          {data: 'equipment'},
          {data: 'old_unit_no'},
          {data: 'new_unit_no'},
          {data: 'creator'},
          {data: 'action'},
        ],
        fixedHeader: true,
      })
    });
  </script>

@endsection