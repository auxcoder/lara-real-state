@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header
        title="Edit User"
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Users', 'url' => route('users.index')],
            ['label' => 'Edit']
        ]"
    />

    <x-admin.card class="mb-4">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.users._form')
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i>Update User
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </a>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection
