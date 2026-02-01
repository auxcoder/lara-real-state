@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header
        title="Add Role"
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Roles', 'url' => route('roles.index')],
            ['label' => 'Create']
        ]"
    />

    <x-admin.card class="mb-4">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            @include('admin.roles._form')
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i>Create Role
                </button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </a>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection
