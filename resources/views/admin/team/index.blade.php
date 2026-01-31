@extends('admin.layout.master')

@section('content')
<x-admin.page-header 
    title="Team Members" 
    :breadcrumbs="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Team Members']
    ]"
>
    <a href="{{ route('team.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Member
    </a>
</x-admin.page-header>

<x-admin.card>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Position</th>
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
