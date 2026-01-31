@extends('admin.layout.master')

@section('content')
<div class="container">
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Developers</h1>
        @can('create', App\Models\Developer::class)
            <a href="{{ route('developers.create') }}" class="btn btn-primary">Add Developer</a>
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
                                    <img src="{{ asset('storage/' . $developer->logo) }}" alt="{{ $developer->name }}" width="50" class="img-thumbnail">
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
                                @can('view', $developer)
                                    <a href="{{ route('developers.show', $developer->id) }}" class="btn btn-sm btn-info" title="View">View</a>
                                @endcan

                                @can('update', $developer)
                                    <a href="{{ route('developers.edit', $developer->id) }}" class="btn btn-sm btn-warning" title="Edit">Edit</a>
                                @endcan

                                @can('delete', $developer)
                                    <form action="{{ route('developers.destroy', $developer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">Delete</button>
                                    </form>
                                @endcan
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
    </div>
</div>
@endsection
