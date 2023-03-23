@extends('templates.main')

@section('title_page')
    Projects
@endsection

@section('breadcrumb_title')
    projects
@endsection

@section('content')
    <div class="row">
      <div class="col-12">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Edit Project Data</h3>
            <a href="{{ route('projects.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-arrow-left"></i> Back</a>
          </div> {{-- card-header --}}

          <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf @method('PATCH')
            <div class="card-body">
              <div class="form-group">
                <label for="project_code">Project Code</label>
                <input name="project_code" value="{{ old('project_code', $project->project_code) }}" type="text" class="form-control @error('project_code') is-invalid @enderror" id="project_code" autofocus>
                @error('project_code')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="bowheer">Bouwheer</label>
                <input name="bowheer" value="{{ old('bowheer', $project->bowheer) }}" type="text" class="form-control @error('bowheer') is-invalid @enderror" id="bowheer">
                @error('bowheer')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="location">Location</label>
                <input name="location" value="{{ old('location', $project->location) }}" type="text" class="form-control @error('location') is-invalid @enderror" id="location">
                @error('location')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input name="address" value="{{ old('address', $project->address) }}" type="text" class="form-control" id="address">
              </div>
              <div class="form-group">
                <label for="city">City</label>
                <input name="city" value="{{ old('city', $project->city) }}" type="text" class="form-control" id="city">
              </div>
              <div class="form-group">
                <label for="isActive">isActive</label>
                <select name="isActive" class="form-control" id="isActive">
                  <option value="1" {{ $project->isActive == 1 ? 'selected' : '' }}>Active</option>
                  <option value="0" {{ $project->isActive == 0 ? 'selected' : '' }}>in-Active</option>
                </select>
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



