<form action="{{ route('plant_groups.destroy', $model->id) }}" method="POST">
@csrf @method('DELETE')
  @can('edit_plant_groups')
    <a href="{{ route('plant_groups.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
  @endcan
  @can('delete_plant_groups')
    <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
  @endcan
</form>
