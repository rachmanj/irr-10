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
            {{-- a as button --}}
            <a href="{{ route('reports.index') }}" class="btn btn-sm btn-primary float-right mx-2"><i class="fas fa-arrow-left"></i> Back</a>
            <form action="{{ route('reports.summary_ipa.export') }}" method="POST" class="float-right">
              @csrf
              <input type="hidden" name="date" value="{{ $date }}">
              <button type="submit" class="btn btn-sm btn-warning float-right"><i class="fas fa-excel"></i> Export to Excel</button>
            </form>
          </div> {{-- card-header --}}

          <div class="card-header">
            <div class="col-6">
              <form action="{{ route('reports.summary_ipa.display') }}" method="POST">
                @csrf
                <div class="input-group input-group-sm">
                  <label for="date" class="form-label">Select Month</label>
                  <input type="month" value="{{ $date }}" name="date" class="form-control ml-3" placeholder="select month">
                  <span class="input-group-append">
                    <button type="submit" class="btn btn-info btn-flat">submit</button>
                  </span>
                </div>
              </form>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-head-fixed text-nowrap table-striped table-bordered" id="movings">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>IPA No</th>
                  <th>Date</th>
                  <th>From | To</th>
                  <th>Equipments</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($movings as $item)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $item->ipa_no }}</td>
                      <td>{{ date('d-M-Y', strtotime($item->ipa_date)) }}</td>
                      <td>{{ $item->from_project->project_code . " | " . $item->to_project->project_code  }}</td>
                      <td>
                        @foreach ($item->moving_details as $detail)
                          <button class="btn btn-outline-success btn-sm" style="pointer-events: none">{{ $detail->equipment->unit_no }}</button>
                        @endforeach
                      </td>
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
    $('#movings').DataTable();
  });
</script>
@endsection
