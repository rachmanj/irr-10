<div class="tab-pane fade show active" id="custom-tabs-four-movings" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
  <table class="table table-bordered table-striped">
    <tr>
      <th>#</th>
      <th>IPA No</th>
      <th>Date</th>
      <th>From</th>
      <th>To</th>
    </tr>
    @foreach ($ipas as $ipa)
          <tr>
            <td width="5%">{{ $loop->iteration }}</td>
            <td>{{ $ipa->ipa_no }}</td>
            <td>{{ date('d-M-Y', strtotime($ipa->ipa_date)) }}</td>
            <td>{{ $ipa->from_project }}</td>
            <td>{{ $ipa->to_project }}</td>
          </tr>
      @endforeach
  </table>
</div>