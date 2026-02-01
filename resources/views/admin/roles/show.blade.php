@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header
        title="Role Details"
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Roles', 'url' => route('roles.index')],
            ['label' => 'View']
        ]"
    />

    <x-admin.card class="mb-4">
        <x-slot name="actions">
            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil me-1"></i>Edit
            </a>
        </x-slot>

        <div class="row">
            <div class="col-md-8">
                <table class="align-middle table table-borderless">
                    <tbody>
                        <tr>
                            <th width="200">Name:</th>
                            <td>{{ $role->name }}</td>
                        </tr>
                        <tr>
                            <th>Permissions:</th>
                            <td>
                                @if(!empty($rolePermissions) && $rolePermissions->count() > 0)
                                    @foreach($rolePermissions as $permission)
                                        <span class="bg-success badge me-1">{{ $permission->name }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">No permissions assigned</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>Back to List
            </a>
        </div>
    </x-admin.card>
</div>
@endsection

