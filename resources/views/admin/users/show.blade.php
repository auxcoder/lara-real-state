@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="User Details" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Users', 'url' => route('users.index')],
            ['label' => 'View']
        ]" 
    />

    <x-admin.card>
        <x-slot name="actions">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil me-1"></i>Edit
            </a>
        </x-slot>

        <div class="row">
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th width="200">Name:</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Roles:</th>
                            <td>
                                @if($user->getRoleNames()->isNotEmpty())
                                    @foreach($user->getRoleNames() as $role)
                                        <span class="badge bg-success text-capitalize">{{ $role }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">No roles assigned</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>Back to List
            </a>
        </div>
    </x-admin.card>
</div>
@endsection
