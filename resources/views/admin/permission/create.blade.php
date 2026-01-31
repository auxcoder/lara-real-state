@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Add Permission" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Permissions', 'url' => route('permission.index')],
            ['label' => 'Create']
        ]" 
    />

    <x-admin.card>
        <form action="{{ route('permission.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i>Create Permission
                </button>
                <a href="{{ route('permission.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </a>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection
