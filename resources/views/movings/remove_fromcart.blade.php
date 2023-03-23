<form action="{{ route('moving_details.remove_fromcart', $model->id) }}" method="POST">
  @csrf @method('PATCH')
  {{-- <input type="hidden" name="moving_id" value="{{ $moving->id }}"> --}}
  <button type="submit" class="btn btn-xs btn-primary"><i class="fas fa-arrow-up"></i></button>
</form>