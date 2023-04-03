<form action="{{ route('documents.destroy', $model->id) }}" method="POST">
  @csrf @method('DELETE')
  @if ($model->filename) <a href="{{ asset('document_upload/') . '/'. $model->filename }}" class='btn btn-xs btn-success' target=_blank>show file</a> @endif
  @can('edit_documents')
    <a href="{{ route('documents.edit', $model->id) }}" class="btn btn-xs btn-warning">edit</a>
  @endcan
  @can('delete_documents')
      <button type="submit" onclick="return confirm('Yakin nih mau menghapus data? Ga bisa dibalikin lagi lho datanya..')" class="btn btn-xs btn-danger">delete</button>
  @endcan
</form>

