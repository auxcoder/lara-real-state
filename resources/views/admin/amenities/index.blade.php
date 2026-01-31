@extends('admin.layout.master')

@section('content')
<div class="container">
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Amenities</h1>
        @can('create', App\Models\Amenity::class)
            <a href="{{ route('amenity.create') }}" class="btn btn-primary">Add Amenity</a>
        @endcan
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-dismissible alert-success fade show">
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
                        <th>#</th>
                        <th>Name</th>
                        <th>Logo</th>
                        <th>Description</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Amenity as $amenity)
                        <tr>
                            <td>{{ $amenity->id }}</td>
                            <td>{{ $amenity->name }}</td>
                            <td><img src="{{ asset('storage/' . $amenity->logo) }}" width="50" height="50"></td>
                            <td>{{ Str::limit($amenity->description, 50) }}</td>
                            <td class="text-end">
                                @can('view', $amenity)
                                    <a href="{{ route('Amenity.show', $amenity->id) }}" class="btn btn-info btn-sm">View</a>
                                @endcan
                                @can('update', $amenity)
                                    <a href="{{ route('Amenity.edit', $amenity->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                @endcan
                                @can('delete', $amenity)
                                    <button type="button" class="btn btn-danger btn-sm"
                                            hx-delete="{{ route('Amenity.destroy', $amenity->id) }}"
                                            hx-confirm="Delete {{ $amenity->name }}?"
                                            hx-target="closest tr"
                                            hx-swap="outerHTML swap:1s">
                                        Delete
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $Amenity->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
