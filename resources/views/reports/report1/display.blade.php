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
            <h3 class="card-title">{{ $report_name }}</h3>
            <a href="{{ route('reports.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-undo"></i> Back</a>
          </div> {{-- card-header --}}

          <div class="card-header">
            <div class="col-3">
              <form action="{{ route('reports.report1_display') }}" method="POST">
                @csrf
                <div class="input-group input-group-sm">
                  <input type="month" value="{{ $date }}" name="date" class="form-control">
                  <span class="input-group-append">
                    <button type="submit" class="btn btn-info btn-flat">submit</button>
                  </span>
                </div>
              </form>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-head-fixed text-nowrap table-striped table-bordered" id="report1">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Unit No</th>
                  <th>Model</th>
                  <th>Activation Date</th>
                  <th>Project</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($equipments as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->unit_no }}</td>
                      <td>{{ $item->unitmodel->model_no }}</td>
                      <td>{{ date('d-M-Y', strtotime($item->active_date)) }}</td>
                      <td>{{ $item->current_project->project_code }}</td>
                    </tr>
                  @endforeach   
              </tbody>
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
  $(document).ready(function() {
    $('#report1').DataTable();
  });
</script>
@endsection
