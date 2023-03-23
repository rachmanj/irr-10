<form action="{{ route('projects.destroy', $model->id) }}" method="POST">
  @csrf @method('DELETE')
    @can('edit_projects')
      <a href="{{ route('projects.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>  
    @endcan
    @can('delete_projects')
    <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')">delete</button>
    @endcan
</form>

