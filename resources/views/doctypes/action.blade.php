@if ($model->name != 'STNK' && $model->name != 'BPKB' && $model->name != 'Polis Asuransi' && $model->name != 'Purchase Order' && $model->name != 'Other Payment')
  <form action="{{ route('doctypes.destroy', $model->id) }}" method="POST">
    @csrf @method('DELETE')
      @can('edit_doctype')
      <a href="{{ route('doctypes.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
      @endcan
      @can('delete_doctype')
      <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
      @endcan
  </form>
@endif
