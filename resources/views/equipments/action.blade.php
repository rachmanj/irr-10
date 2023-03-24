<form action="{{ route('equipments.destroy', $model->id) }}" method="POST">
@csrf @method('DELETE')
  <a href="{{ route('equipments.show', $model->id) }}" class="btn btn-xs btn-success">show</a>
    @can('edit_equipment')
      <a href="{{ route('equipments.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
    @endcan
    @can('edit_equipment_detail')
      <a href="{{ route('equipments.edit_detail', $model->id) }}" class="btn btn-xs btn-primary">edit detail</a>
    @endcan
    @can('delete_equipment')
      <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
    @endcan
</form>
