  <form action="{{ route('movings.destroy', $model->id) }}" method="POST">
    @csrf @method('DELETE')
      <a href="{{ route('movings.print_pdf', $model->id) }}" class="btn btn-xs btn-success" target="_blank">print</a>
    @can('edit_movings')
      <a href="{{ route('movings.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
    @endcan
    @can('delete_movings')
      <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
    @endcan
  </form>

