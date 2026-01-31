@extends('admin.layout.master')

@section('content')
<div class="container">
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Agents</h1>
        @can('create', App\Models\Agents::class)
            <a href="{{ route('agents.create') }}" class="btn btn-primary">Add New Agent</a>
        @endcan
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Data Table --}}
    <div class="card">
        <div class="card-body">
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
                                @can('view', $agent)
                                    <a href="{{ route('agents.show', $agent->id) }}" class="btn btn-sm btn-info" title="View">View</a>
                                @endcan
                                
                                @can('update', $agent)
                                    <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-sm btn-warning" title="Edit">Edit</a>
                                @endcan
                                
                                @can('delete', $agent)
                                    <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">Delete</button>
                                    </form>
                                @endcan
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
    </div>
</div>
@endsection
