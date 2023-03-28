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
            @can('create_equipment')
              <a href="{{ route('equipments.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Equipment</a>
            @endcan
            @can('export_equipment')
              <a href="{{ route('equipments.export_excel') }}" class="btn btn-sm btn-success"><i class="fas fa-print"></i> Export to Excel</a>
            @endcan
          </div> {{-- card-header --}}

          <div class="card-body">
            <table id="equipments" class="table table-bordered table-striped datatable datatable-Asset">
              <thead>
                <tr>
                  <td></td>
                  <td>
                    <input type="text" class="search form-control" placeholder="unit no">
                  </td>
                  <td>
                    <input type="text" class="search form-control" placeholder="model">
                  </td>
                  <td>
                    <input type="text" class="search form-control" placeholder="asset category">
                  </td>
                  <td>
                    <input type="text" class="search form-control" placeholder="manufacture">
                  </td>
                  <td>
                    <input type="text" class="search form-control" placeholder="S/N">
                  </td>
                  <td>
                    <input type="text" class="search form-control" placeholder="plant type">
                  </td>
                  <td>
                    <input type="text" class="search form-control" placeholder="location">
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <th>No</th>
                  <th>Unit No</th>
                  <th>Model</th>
                  <th>Asset Category</th>
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
      let dtOverrideGlobals = {
        processing: true,
        serverSide: true,
        retrieve: true,
        aaSorting: [],
        ajax: "{{ route('equipments.index.data') }}",
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'unit_no'},
          {data: 'model'},
          {data: 'asset_category'},
          {data: 'manufacture'},
          {data: 'serial_no'},
          {data: 'plant_type'},
          {data: 'current_project'},
          {data: 'action'},
        ],
        orderCellsTop: true,
        order: [[ 1, 'asc' ]],
        pageLength: 10,
      };

    let table = $('#equipments').DataTable(dtOverrideGlobals);

    $('.datatable thead').on('input', '.search', function () {
        let strict = $(this).attr('strict') || false
        let value = strict && this.value ? "^" + this.value + "$" : this.value
        table
          .column($(this).parent().index())
          .search(value, strict)
          .draw()
      });
    });
  </script>

@endsection