@extends('admin.layout.master')


@section('content')
<div class="container">
    <h1>Edit Agent</h1>

    <form action="{{ route('agents.update', $agent->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $agent->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $agent->email }}"
                required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $agent->phone }}">
        </div>

        <div class="mb-3">
            <label for="profile_image" class="form-label">Current Profile Image</label>
            @if ($agent->profile_image)
                <div>
                    <img src="{{ asset('storage/' . $agent->profile_image) }}" alt="Profile Image" class="img-thumbnail"
                        width="150">
                </div>
            @else
                <p>No profile image available.</p>
            @endif
        </div>

        <div class="mb-3">
            <label for="profile_image" class="form-label">Upload New Profile Image</label>
            <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="license_number" class="form-label">License Number</label>
            <input type="text" class="form-control" id="license_number" name="license_number"
                value="{{ $agent->license_number }}">
        </div>

        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea class="form-control" id="bio" name="bio">{{ $agent->bio }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="active" {{ $agent->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $agent->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Agent</button>
    </form>
</div>
@endsection
