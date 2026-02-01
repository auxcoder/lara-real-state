@extends('admin.layout.master')

@section('content')
<x-admin.page-header
    title="Edit Team Member"
    :breadcrumbs="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Team Members', 'url' => route('team.index')],
        ['label' => 'Edit Member']
    ]"
/>

<x-admin.card class="mb-4">
    <form action="{{ route('team.update', $team->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $team->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">ID</label>
            <input type="text" name="NID" class="form-control @error('NID') is-invalid @enderror" value="{{ old('NID', $team->NID) }}" required>
            @error('NID')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $team->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Position</label>
            <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $team->position) }}" required>
            @error('position')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Specialties</label>
            <textarea name="specialties" class="form-control @error('specialties') is-invalid @enderror" required>{{ old('specialties', $team->specialties) }}</textarea>
            @error('specialties')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $team->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Experience</label>
            <textarea name="experience" class="form-control @error('experience') is-invalid @enderror" required>{{ old('experience', $team->experience ?? '') }}</textarea>
            @error('experience')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Languages</label>
            <textarea name="languages" class="form-control @error('languages') is-invalid @enderror" required>{{ old('languages', $team->languages ?? '') }}</textarea>
            @error('languages')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Profile Image</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
            @if($team->image)
                <img src="{{ asset('uploads/' . $team->image) }}" width="100" class="mt-2">
            @endif
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Facebook</label>
            <input type="url" name="facebook" class="form-control @error('facebook') is-invalid @enderror" value="{{ old('facebook', $team->facebook) }}">
            @error('facebook')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Twitter</label>
            <input type="url" name="twitter" class="form-control @error('twitter') is-invalid @enderror" value="{{ old('twitter', $team->twitter) }}">
            @error('twitter')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">LinkedIn</label>
            <input type="url" name="linkedin" class="form-control @error('linkedin') is-invalid @enderror" value="{{ old('linkedin', $team->linkedin) }}">
            @error('linkedin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Instagram</label>
            <input type="url" name="instagram" class="form-control @error('instagram') is-invalid @enderror" value="{{ old('instagram', $team->instagram) }}">
            @error('instagram')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                <i class="fa-save fas"></i> Update
            </button>
            <a href="{{ route('team.index') }}" class="btn btn-secondary">
                <i class="fa-arrow-left fas"></i> Back
            </a>
        </div>
    </form>
</x-admin.card>
@endsection
