@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Agents" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Agents']
        ]" 
    />

    <x-admin.card>
        <x-slot name="actions">
            @can('create', App\Models\Agents::class)
                <a href="{{ route('agents.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Add New Agent
                </a>
            @endcan
        </x-slot>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agents as $agent)
                        <tr>
                            <td>{{ $agent->id }}</td>
                            <td>{{ $agent->name }}</td>
                            <td>{{ $agent->email }}</td>
                            <td>{{ $agent->phone }}</td>
                            <td>
                                <span class="badge bg-{{ $agent->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($agent->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <x-admin.crud-actions 
                                    :showRoute="route('agents.show', $agent->id)"
                                    :editRoute="route('agents.edit', $agent->id)"
                                    :deleteRoute="route('agents.destroy', $agent->id)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No agents found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $agents->links() }}
            </div>
        </div>
    </x-admin.card>
</div>
@endsection
