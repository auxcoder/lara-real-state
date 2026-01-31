@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Add User" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Users', 'url' => route('users.index')],
            ['label' => 'Create']
        ]" 
    />

    <x-admin.card>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            @include('admin.users._form')
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i>Create User
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </a>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection
