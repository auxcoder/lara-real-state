@extends('admin.layout.master')

@section('content')
<x-admin.page-header 
    :title="__('Team Members')" 
    :breadcrumbs="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => __('Team Members')]
    ]"
>
    @can('create team')
        <a href="{{ route('team.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Member
        </a>
    @endcan
</x-admin.page-header>

<x-admin.card>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table align-middle table-bordered">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Position') }}</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->position }}</td>
                    <td>
                        <x-admin.crud-actions 
                            :item="$member"
                            route-prefix="team"
                            :show-view="true"
                            editPermission="edit team"
                            deletePermission="delete team"
                        />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="mt-3">
        {{ $members->links() }}
    </div>
</x-admin.card>
@endsection
