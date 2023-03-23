<!doctype html>
<html lang="en" class="h-100">

<head>
  <title>Instruksi Pemindahan Alat (IPA) - PT. Arkananta Apta Pratista</title>
  <!-- Bootstrap core CSS -->
  <link href="{{ asset('assets_ipa/dist/css/bootstrap.min.css') }}" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="{{ asset('assets_ipa/dist/css/sticky-footer.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

  <!-- Begin page content -->
  <main class="flex-shrink-0">
    <div class="container">
      <table width="100%" cellspacing="0" class="mb-1">
        <tr>
          <td>
            <div><img src="{{ asset('assets_ipa/images/logo3.png') }}" width="200" height="40" /></div>
          </td>
        </tr>
      </table>
      <table width="100%" cellspacing="0" class="mb-3">
        <tr>
          <td>
            <div class="text-center fs-5"><b>PT. ARKANANTA APTA PRATISTA</b></div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="text-center text-decoration-underline fs-6"><b>INSTRUKSI PEMINDAHAN ALAT (I P A)</b></div>
          </td>
        </tr>
        <tr>
          <td>
            <div class="text-center"><b>No. {{ $moving->ipa_no }}</b></div>
          </td>
        </tr>
      </table>
      <table width="100%" cellpadding="3px" class="table-bordered mb-3">
        <tr>
          <td>
            <div class="fw-bold">Kepada Yth.</div>
            <p class="ms-3">{{ $moving->tujuan_row_1 }}<br>{{ $moving->tujuan_row_2 }}</p>
          </td>
        </tr>
        <tr>
          <td>
            <div class="fw-bold">Cc.</div>
            <p class="ms-3">- {{ $moving->cc_row_1 }}<br>
              - {{ $moving->cc_row_2 }}<br>
              - {{ $moving->cc_row_3 }}</p>
          </td>
        </tr>
      </table>
      <table width="100%" cellpadding="3px">
        <tr>
          <td>
            <div>
              Dengan Hormat.<br>
              Sesuai dengan kebutuhan Operasional Perusahaan, mohon segera dilakukan pemindahan alat sbb.: 
            </div>
          </td>
        </tr>
      </table>
      <table width='100%' cellpadding="5px" class="table-bordered">
        <tr>
          <th>Dari</th>
          <th>Tujuan</th>
        </tr>
        <tr>
          <td>{{ $moving->from_project->project_code .' - '. $moving->from_project->bowheer .','. $moving->from_project->location }}</td>
          <td>{{ $moving->to_project->project_code .' - '. $moving->to_project->bowheer .','. $moving->to_project->location }}</td>
        </tr>
      </table>
      <hr>
      <table width='100%' cellpadding="5px" class="table-bordered">
        <thead>
          <tr>
            <th>Unit No</th>
            <th>Description</th>
            <th>S/N</th>
            <th>Engine Model</th>
            <th>Engine No</th>
            {{-- <th>Manufacture</th> --}}
          </tr>
        </thead>
        <tbody>
          @foreach ($moving->moving_details as $detail)
              <tr>
                <td>{{ $detail->equipment->unit_no }}</td>
                <td><small>{{ $detail->equipment->description }}</small></td>
                <td>{{ $detail->equipment->serial_no }}</td>
                <td>{{ $detail->equipment->engine_model }}</td>
                <td>{{ $detail->equipment->machine_no }}</td>
                {{-- <td>{{ $detail->equipment->unitmodel->manufacture->name }}</td> --}}
              </tr>
          @endforeach
              <tr>
                <td colspan="5"><b>Remarks:</b> {{ $moving->remarks }} </td>
              </tr>
        </tbody>
      </table>

      <hr>
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
  </main>

  <footer class="footer mt-auto py-3 bg-white">
    <div class="container">
      <table class="text-muted" width=100%>
        <tr>
          <td width=30% class="text-start">sheet 1 : HO Jakarta</td>
          <td width=30% class="text-center">sheet 2 : Pengirim Unit</td>
          <td width=30% class="text-end">sheet 3 : Penerima Unit</td>
        </tr>
      </table>
    </div>
  </footer>

<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>

</body>

</html>