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
            <h3 class="card-title">Reports</h3>
          </div> {{-- card-header --}}

          <div class="card-body">
            <ol>
              <li><b>Equipment</b></li>
              <ol>
                <li>Equipment by Projects</li>
                <li><a href="{{ route('reports.report1_create') }}">Equipments Activation by Month</a></li>
              </ol>
              <li><b>Documents</b></li>
              <ol>
                <li><a href="{{ route('reports.document_with_overdue') }}">Documents yang akan jatuh tempo</a></li>
              </ol>
              <li><b>Movings</b></li>
              <ol>
                <li><a href="{{ route('reports.summary_ipa.index') }}">Summary IPA</a></li>
              </ol>
            </ol>
          </div> {{-- card-body --}}
        </div> {{-- card --}}
      </div>
    </div>
@endsection
