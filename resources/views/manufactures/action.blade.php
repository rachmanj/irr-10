<form action="{{ route('manufactures.destroy', $model->id) }}" method="POST">
    @csrf @method('DELETE')
    @can('edit_manufactures')
    <a href="{{ route('manufactures.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
    @endcan
    @can('delete_manufactures')
      <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
    @endcan   
 </form>

