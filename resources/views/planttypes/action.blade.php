<form action="{{ route('planttypes.destroy', $model->id) }}" method="POST">
  @csrf @method('DELETE')
    @can('edit_planttypes')
    <a href="{{ route('planttypes.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
    @endcan
    @can('delete_planttypes')
    <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
    @endcan
</form>

