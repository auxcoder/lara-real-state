@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Edit Role" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Roles', 'url' => route('roles.index')],
            ['label' => 'Edit']
        ]" 
    />

    <x-admin.card>
        <form action="{{ route('roles.update', $roles->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.roles._form', ['role' => $roles])
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i>Update Role
                </button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </a>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection
