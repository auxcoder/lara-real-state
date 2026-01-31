@extends('admin.layout.master')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit Amenity</h1>
            <form action="{{ route('Amenity.update', $amenity->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name"
                        value="{{ $amenity->name }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control" id="logo"
                        value="{{ old('logo') }}">
                    @error('logo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ $amenity->description }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Assuming you have an array of communities -->
                <select name="community_ids[]" multiple>
                    @foreach ($communities as $community)
                        <option value="{{ $community->id }}"
                            {{ $amenity->communities->contains($community->id) ? 'selected' : '' }}>
                            {{ $community->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success">Update Amenity</button>
            </form>
        </div>
    </div>
</div>
@endsection
