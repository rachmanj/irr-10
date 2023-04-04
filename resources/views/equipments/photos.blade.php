@extends('templates.main')

@section('title_page')
    Equipments
@endsection

@section('breadcrumb_title')
<a href="{{ route('equipments.index') }}">equipments</a>
@endsection

@section('content')
{{-- create photos gallery --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('equipments.show', $equipment->id) }}">Equipment Data</a> | <a href="#"><strong>Photos</strong></a>
                <a href="{{ route('equipments.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-arrow-left"></i>  Back</a>
            </div>
            <div class="card-header">
                {{-- add button to call modal create --}}
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createPhoto">
                    <i class="fas fa-plus"></i> Photo
                </button>
            </div>

            <div class="card-body">
                <div class="row">
                    @foreach ($photos as $photo)
                    <div class="col-sm-2">
                        <a href="{{ asset('images') . '/' . $photo->filename }}" data-toggle="lightbox" data-title="{{ $photo->description }}" data-gallery="gallery">
                          <img src="{{ asset('images') . '/' . $photo->filename }}" class="img-fluid mb-2" alt="image-{{ $photo->id }}"/>
                        </a>
                        <form action="{{ route('equipments.photos.destroy', $photo->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="equipment_id" value="{{ $photo->id }}">
                            <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete this record?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal create photo --}}
<div class="modal fade" id="createPhoto">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload Photo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('equipments.photos.store', $equipment->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control">
              </div>
            <div class="form-group">
              <label for="file_upload">File</label>
              <input type="file" name="file_upload" id="file_upload" class="form-control">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> Submit</button>
          </div>
        </form>
      </div> <!-- /.modal-content -->
    </div> <!-- /.modal-dialog -->
</div> <!-- /.modal -->
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('adminlte/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<script>
    $(function () {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });
    })
  </script>
@endsection