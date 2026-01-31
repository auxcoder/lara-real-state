@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Edit Master Plan" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Master Plans', 'url' => route('master-plans.index')],
            ['label' => 'Edit']
        ]" 
    />

    <x-admin.card class="mb-4">
        <form action="{{ route('master-plans.update', $masterPlan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $masterPlan->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                @if($masterPlan->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $masterPlan->image) }}" width="100" class="rounded">
                    </div>
                @endif
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image" accept="image/*">
                <small class="text-muted">Leave empty to keep current image</small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="3" required>{{ old('description', $masterPlan->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i>Update Master Plan
                </button>
                <a href="{{ route('master-plans.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </a>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection