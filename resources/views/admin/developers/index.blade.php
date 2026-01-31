@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Developers" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Developers']
        ]" 
    />

    <x-admin.card>
        <x-slot name="actions">
            @can('create', App\Models\Developer::class)
                <a href="{{ route('developers.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Add Developer
                </a>
            @endcan
        </x-slot>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Logo</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($developers as $developer)
                        <tr>
                            <td>{{ $developer->name }}</td>
                            <td>{{ $developer->email }}</td>
                            <td>{{ $developer->phone }}</td>
                            <td>
                                @if ($developer->logo)
                                    <img src="{{ asset('storage/' . $developer->logo) }}" alt="{{ $developer->name }}" width="50" class="rounded">
                                @else
                                    <span class="text-muted">No Logo</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $developer->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($developer->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <x-admin.crud-actions 
                                    :showRoute="route('developers.show', $developer->id)"
                                    :editRoute="route('developers.edit', $developer->id)"
                                    :deleteRoute="route('developers.destroy', $developer->id)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No developers found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $developers->links() }}
        </div>
    </x-admin.card>
</div>
@endsection
