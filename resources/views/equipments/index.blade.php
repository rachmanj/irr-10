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
            @can('update_rfu')
              <button class="btn btn-sm btn-warning float-right mx-2" data-toggle="modal" data-target="#update_to_rfu">Update RFU Units</button>
              <button class="btn btn-sm btn-warning float-right" data-toggle="modal" data-target="#update_to_bd">Update B/D Units</button>
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
                  <td>
                    <input type="text" class="search form-control" placeholder="status">
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
                  <th>Status</th>
                  <th>action</th>
                </tr>
              </thead>
            </table>
          </div> {{-- card-body --}}
        </div> {{-- card --}}
      </div>
    </div>

    {{-- MODAL UPDATE TO RFU --}}
    <div class="modal fade" id="update_to_rfu">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Update to RFU</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('equipments.update_rfu') }}" method="POST">
            @csrf  @method('POST')
            
            <div class="modal-body">
              <div class="form-group">
                <label>Select Equipments to update to RFU</label>
                <div class="select2-purple">
                  <select name="equipments[]" class="select2 form-control" multiple="multiple" data-dropdown-css-class="select2-purple" data-placeholder="Select Equipments" style="width: 100%;">
                    @foreach (\App\Models\Equipment::where('is_rfu', 0)->where('unitstatus_id', 1)->get() as $equipment)
                      <option value="{{ $equipment->id }}">{{ $equipment->unit_no . ' - ' . $equipment->description }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer float-left">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"> Close</button>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
            </div>
            </form>
        </div> <!-- /.modal-content -->
      </div> <!-- /.modal-dialog -->
    </div>

    {{-- MODAL UPDATE TO RFU --}}
    <div class="modal fade" id="update_to_bd">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Update to B/D</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('equipments.update_bd') }}" method="POST">
            @csrf  @method('POST')
            
            <div class="modal-body">
              <div class="form-group">
                <label>Select Equipments to update to B/D</label>
                <div class="select2-purple">
                  <select name="equipments[]" class="select2 form-control" multiple="multiple" data-dropdown-css-class="select2-purple" data-placeholder="Select Equipments" style="width: 100%;">
                    @foreach (\App\Models\Equipment::where('is_rfu', 1)->where('unitstatus_id', 1)->get() as $equipment)
                      <option value="{{ $equipment->id }}">{{ $equipment->unit_no . ' - ' . $equipment->description }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer float-left">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"> Close</button>
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save</button>
            </div>
            </form>
        </div> <!-- /.modal-content -->
      </div> <!-- /.modal-dialog -->
    </div>

@endsection

@section('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/plugins/datatables/css/datatables.min.css') }}"/>
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('scripts')
  <!-- DataTables  & Plugins -->
  <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('adminlte/plugins/datatables/datatables.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>

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
          {data: 'is_rfu'},
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
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    }) 
  </script>

@endsection