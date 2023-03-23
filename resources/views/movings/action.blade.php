@if (auth()->user()->role === 'superadmin' || auth()->user()->role == 'admin')
  <form action="{{ route('movings.destroy', $model->id) }}" method="POST">
    @csrf @method('DELETE')
    <a href="{{ route('movings.print_pdf', $model->id) }}" class="btn btn-xs btn-success" target="_blank">print</a>
    <a href="{{ route('movings.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
    @if (auth()->user()->role === 'superadmin')
      <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
    @endif
  </form>
@endif
