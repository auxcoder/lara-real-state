@extends('admin.layout.master')

@section('content')
<div class="container">
    <h2 class="my-3">Team Members</h2>
    <a href="{{ route('team.create') }}" class="mb-3 btn btn-primary">Add Member</a>

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
                        <a href="{{ route('team.edit', $member->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <button type="button" class="btn btn-danger btn-sm"
                                hx-delete="{{ route('team.destroy', $member->id) }}"
                                hx-confirm="Delete {{ $member->name }}?"
                                hx-target="closest tr"
                                hx-swap="outerHTML swap:1s">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="mt-3">
        {{ $members->links() }}
    </div>
</div>
@endsection
