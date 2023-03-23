<form action="{{ route('equipments.destroy', $model->id) }}" method="POST">
@csrf @method('DELETE')
  <a href="{{ route('equipments.show', $model->id) }}" class="btn btn-xs btn-success">show</a>
  @if (auth()->user()->role === 'superadmin' || auth()->user()->role === 'admin')
    <a href="{{ route('equipments.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
    <a href="{{ route('equipments.edit_detail', $model->id) }}" class="btn btn-xs btn-primary">edit detail</a>
    @if (auth()->user()->role === 'superadmin')
      <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
    @endif
  @endif
</form>
