@extends('templates.main')

@section('title_page')
    Projects
@endsection

@section('breadcrumb_title')
    projects
@endsection

@section('content')
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <a href="{{ route('projects.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Project</a>
          </div> {{-- card-header --}}

          <div class="card-body">
            <table id="projects" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Code</th>
                  <th>Bouwheer</th>
                  <th>Location</th>
                  <th>isActive</th>
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
  <script src="{{ asset('adminlte/plugins/bs-notify.min.js') }}"></script>

  <script>
    $(function () {
      $("#projects").DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('projects.data') }}',
        columns: [
          {data: 'DT_RowIndex', orderable: false, searchable: false},
          {data: 'project_code'},
          {data: 'bowheer'},
          {data: 'location'},
          {data: 'isActive'},
          {data: 'action'},
        ],
        fixedHeader: true,
      })
    });
  </script>

@endsection