@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header
        title="Developer Properties"
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Developer Properties']
        ]"
    />

    <x-admin.card>
        <x-slot name="actions">
            @can('create', App\Models\DeveloperProperty::class)
                <a href="{{ route('developer_properties.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Add Developer Property
                </a>
            @endcan
        </x-slot>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Developer</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($developer_properties as $property)
                        <tr>
                            <td>{{ $property->name }}</td>
                            <td>{{ $property->developer->name ?? 'N/A' }}</td>
                            <td>
                                <span class="bg- badge{{ $property->status == 'new' ? 'success' : 'secondary' }}">
                                    {{ ucfirst(str_replace('_', ' ', $property->status)) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <x-admin.crud-actions
                                    :showRoute="route('developer_properties.show', $property->id)"
                                    :editRoute="route('developer_properties.edit', $property->id)"
                                    :deleteRoute="route('developer_properties.destroy', $property->id)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-muted">No developer properties found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-admin.card>
</div>
@endsection
