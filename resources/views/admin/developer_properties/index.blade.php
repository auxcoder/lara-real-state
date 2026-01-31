@extends('admin.layout.master')

@section('content')
<div class="container">
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Developer Properties</h1>
        @can('create', App\Models\DeveloperProperty::class)
            <a href="{{ route('developer_properties.create') }}" class="btn btn-primary">Add Developer Property</a>
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
                                <span class="badge bg-{{ $property->status == 'new' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($property->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                @can('update', $property)
                                    <a href="{{ route('developer_properties.edit', $property->id) }}" class="btn btn-sm btn-warning" title="Edit">Edit</a>
                                @endcan

                                @can('delete', $property)
                                    <form action="{{ route('developer_properties.destroy', $property->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">Delete</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No developer properties found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
