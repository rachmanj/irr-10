@extends('templates.main')

@section('title_page')
    Suppliers
@endsection

@section('breadcrumb_title')
    suppliers
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Edit Supplier Data</h3>
            <a href="{{ route('suppliers.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-arrow-left"></i> Back</a>
          </div> {{-- card-header --}}

          <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf @method('PATCH')
            <div class="card-body">

              <div class="form-group">
                <label for="name">Name</label>
                <input name="name" value="{{ old('name', $supplier->name) }}" type="text" class="form-control" id="name">
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group">
                <label for="remarks">Remarks</label>
                <input name="remarks" value="{{ old('name', $supplier->remarks) }}" type="text" class="form-control @error('remarks') is-invalid @enderror" id="remarks" autofocus>
                @error('remarks')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

            </div> {{-- card-body --}}
  
            <div class="card-footer">
              <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
          </form>

        </div> {{--  card --}}
      </div>
    </div>
@endsection



