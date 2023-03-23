<form action="{{ route('unitmodels.destroy', $model->id) }}" method="POST">
  @csrf @method('DELETE')
    @can('edit_unitmodels')
      <a href="{{ route('unitmodels.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
    @endcan
    @can('delete_unitmodels')
      <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
    @endcan
</form>

  