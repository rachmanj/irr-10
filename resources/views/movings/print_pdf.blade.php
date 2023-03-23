<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Invoice Print</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="{{ asset('adminlte/fontgoogle.css') }}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <div><img src="{{ asset('assets_ipa/images/logo3.png') }}" width="200" height="40" /></div>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="text-center">
      <h3 class="page-header">PT ARKANANTA APTA PRATISTA</h3>
      <h5>INSTRUKSI PEMINDAHAN ALAT (IPA)</h5>
      <h5>No. {{ $moving->ipa_no }}</h5>
    </div>
    <hr>
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        <b>Kepada Yth.</b><br>
        <h6>- {{ $moving->tujuan_row_1 }}</h6>
        <h6>- {{ $moving->tujuan_row_2 }}</h6><br>
      </div>
      <div class="col-sm-6 invoice-col">
        <b>CC</b><br>
        <h6>- {{ $moving->cc_row_1 }}</h6>
        <h6>- {{ $moving->cc_row_2 }}</h6>
        <h6>- {{ $moving->cc_row_3 }}</h6><br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <hr>
    <!-- Table row -->
    <p>Dengan hormat,</p>
    <p>Sesuai dengan kebutuhan Operasional Perusahaan, mohon segera dilakukan pemindahan alat sbb.:</p>
    <div class="row">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Dari</th>
            <th>Tujuan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $moving->from_project->project_code .' - '. $moving->from_project->bowheer .', '. $moving->from_project->location }}</td>
            <td>{{ $moving->to_project->project_code .' - '. $moving->to_project->bowheer .', '. $moving->to_project->location }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <hr>
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Unit No</th>
            <th>Description</th>
            <th>S/N</th>
            <th>Engine Model</th>
            <th>Engine No</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($moving->moving_details as $detail)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $detail->equipment->unit_no }}</td>
              <td>{{ $detail->equipment->description }}</td>
              <td>{{ $detail->equipment->serial_no }}</td>
              <td>{{ $detail->equipment->engine_model }}</td>
              <td>{{ $detail->equipment->machine_no }}</td>
              {{-- <td>{{ $detail->equipment->unitmodel->manufacture->name }}</td> --}}
            </tr>
            @endforeach
            <tr>
              <td colspan="6"><b>Remarks:</b> {{ $moving->remarks }} </td>
            </tr>
          </tbody>
        </table>
        <table width="100%" cellspacing="0">
          <tr>
            <td></td>
            <td></td>
            <td width="30%">
              <div class="text-center">
                <p>Balikpapan, {{ date('d F Y', strtotime($moving->ipa_date)) }}<br>Disetujui oleh
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  (Christina W.)<br>Asset & Insurance Sec. Head
                </p>
              </div>
            </td>
          </tr>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    
  </section>
  <!-- /.content -->
  <footer class="main-footer">
    <table class="text-muted" width=100%>
      <tr>
        <td width=30% class="text-start">sheet 1 : HO Jakarta</td>
        <td width=30% class="text-center">sheet 2 : Pengirim Unit</td>
        <td width=30% class="text-end">sheet 3 : Penerima Unit</td>
      </tr>
    </table>
  </footer>
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>