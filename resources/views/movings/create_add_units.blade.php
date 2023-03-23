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
            <h3 class="card-title">Select equipments to move</h3>
            <a href="{{ route('movings.before_select_equipment', $moving->id) }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-undo"></i> Back</a>
          </div> {{-- card-header --}}

            <div class="card-body">

            <form>
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="ipa_no">IPA No</label>
                    <input name="ipa_no" type="text" class="form-control" value="{{ $moving->ipa_no }}" readonly>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="ipa_date">Date</label>
                    <input name="ipa_date" type="text" class="form-control" value="{{ date('d-M-Y', strtotime($moving->ipa_date)) }}" readonly>
                  </div>
                </div>
              </div> {{-- row --}}

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="from_project">From Project</label>
                    <input class="form-control" type="text" value="{{ $moving->from_project->project_code .' - '. $moving->from_project->bowheer .', '. $moving->from_project->location }}" readonly>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="to_project">To Project</label>
                    <input class="form-control" type="text" value="{{ $moving->to_project->project_code .' - '. $moving->to_project->bowheer .', '. $moving->to_project->location }}" readonly>
                  </div>
                </div>
              </div> {{-- row --}}
            </form>
          </div> {{-- card-body --}}
            
          <hr>

          <div class="card-header">
            <h4>Available Equipment</h4>
          </div>
          <div class="card-body">
            <table id="available_unit" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Unit No</th>
                  <th>Model No</th>
                  <th>Manufacture</th>
                  <th>action</th>
                </tr>
              </thead>
            </table>
          </div>

          <hr>

          <div class="card-header">
            <h4>Equipment to move</h4>
          </div>
          <div class="card-body">
            <table id="unit_incart" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Unit No</th>
                  <th>Model No</th>
                  <th>Manufacture</th>
                  <th>action</th>
                </tr>
              </thead>
            </table>
          </div>

            <form action="{{ route('moving_details.store') }}" method="POST">
              @csrf
              <input type="hidden" name="moving_id" value="{{ $moving->id }}">
              <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Save Equipments</button>
              </div>
            </form>

        </div> {{--  card --}}
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
      //Datatables add to cart
      $("#available_unit").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('moving_details.available_unit.data', $moving->from_project_id) }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'unit_no'},
          {data: 'model_no'},
          {data: 'manufacture'},
          {data: 'action'},
        ],
        fixedHeader: true,
      })

      //datatable units in cart
      $("#unit_incart").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('moving_details.unit_incart.data') }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'unit_no'},
          {data: 'model_no'},
          {data: 'manufacture'},
          {data: 'action'},
        ],
        fixedHeader: true,
      })
    }) 
  </script>
@endsection




