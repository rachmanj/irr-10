<form action="{{ route('unitstatuses.destroy', $model->id) }}" method="POST">
  @csrf @method('DELETE')
    @can('edit_unitstatuses')
      <a href="{{ route('unitstatuses.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
    @endcan
    @can('delete_unitstatuses')
      <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
    @endcan
</form>

