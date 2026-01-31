@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Permissions" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Permissions']
        ]" 
    />

    <x-admin.card>
        <x-slot name="actions">
            @can('create', App\Models\Permission::class)
                <a href="{{ route('permission.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Add Permission
                </a>
            @endcan
        </x-slot>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td class="text-end">
                                <x-admin.crud-actions 
                                    :showRoute="route('permission.show', $permission->id)"
                                    :editRoute="route('permission.edit', $permission->id)"
                                    :deleteRoute="route('permission.destroy', $permission->id)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">No permissions found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-admin.card>
</div>
@endsection
