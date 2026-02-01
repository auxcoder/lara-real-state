@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header
        :title="__('Roles')"
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => __('Roles')]
        ]"
    />

    <x-admin.card>
        <x-slot name="actions">
            @can('create roles')
                <a href="{{ route('roles.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Add Role
                </a>
            @endcan
        </x-slot>

        <div class="table-responsive">
            <table class="align-middle table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td class="text-end">
                                <x-admin.crud-actions
                                    :showRoute="route('roles.show', $role->id)"
                                    :editRoute="route('roles.edit', $role->id)"
                                    :deleteRoute="route('roles.destroy', $role->id)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center text-muted">{{ __('no_records') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $roles->links() }}
        </div>
    </x-admin.card>
</div>
@endsection
