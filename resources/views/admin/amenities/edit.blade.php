@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header
        title="Edit Amenity"
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Amenities', 'url' => route('amenity.index')],
            ['label' => 'Edit']
        ]"
    />

    <x-admin.card class="mb-4">
        <form action="{{ route('Amenity.update', $amenity->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $amenity->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="logo" class="form-label">Logo</label>
                @if($amenity->logo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $amenity->logo) }}" width="100" class="rounded">
                    </div>
                @endif
                <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" id="logo">
                <small class="text-muted">Leave empty to keep current logo</small>
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3">{{ old('description', $amenity->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="community_ids" class="form-label">Communities</label>
                <select name="community_ids[]" id="community_ids" class="form-select" multiple size="5">
                    @foreach ($communities as $community)
                        <option value="{{ $community->id }}" {{ $amenity->communities->contains($community->id) ? 'selected' : '' }}>
                            {{ $community->name }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Hold Ctrl/Cmd to select multiple</small>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i>Update Amenity
                </button>
                <a href="{{ route('amenity.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </a>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection
