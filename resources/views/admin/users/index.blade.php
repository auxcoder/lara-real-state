@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Users" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Users']
        ]" 
    />

    <x-admin.card>
        <x-slot name="actions">
            @can('create', App\Models\User::class)
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Add User
                </a>
            @endcan
        </x-slot>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->getRoleNames()->isNotEmpty())
                                    @foreach ($user->getRoleNames() as $role)
                                        <span class="badge bg-success text-capitalize">{{ $role }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-end">
                                <x-admin.crud-actions 
                                    :showRoute="route('users.show', $user->id)"
                                    :editRoute="route('users.edit', $user->id)"
                                    :deleteRoute="route('users.destroy', $user->id)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </x-admin.card>
</div>
@endsection
