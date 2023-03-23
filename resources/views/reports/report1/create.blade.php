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
                  <input type="month" name="date" class="form-control" placeholder="select month">
                  <span class="input-group-append">
                    <button type="submit" class="btn btn-info btn-flat">submit</button>
                  </span>
                </div>
              </form>
            </div>
          </div>

          <div class="card-body">
            {{--  --}}
          </div> {{-- card-body --}}
        </div> {{-- card --}}
      </div>
    </div>
@endsection


