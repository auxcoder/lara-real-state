@extends('admin.layout.master')

@section('content')
<div class="container">
    <h1>Properties</h1>

    @can('create', App\Models\AgentProperty::class)
        <a href="{{ route('property.create') }}" class="btn btn-primary mb-3">Add New Property</a>
    @endcan

    <table class="table table-bordered table-compact">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Location</th>
                <th>Type</th>
                <th>Price</th>
                <th>Area (sq meter)</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($properties as $property)
                <tr>
                    <td>{{ $property->id }}</td>
                    <td>{{ $property->translations->pluck('title')->implode(' | ') }}</td>

                    <td>{{ $property->location }}</td>
                    <td>{{ $property->property_type }}</td>
                    <td>
                        @if (!is_null($property->price))
                            {{ number_format($property->price, 2) }}
                        @else
                            {{ __('properties.contact_for_price') }}
                        @endif
                    </td>
                    <td>{{ $property->area }}</td>
                    <td>{{ ucfirst($property->status) }}</td>
                    <td>
                        @can('view', $property)
                            <a href="{{ route('property.show', $property->id) }}" class="btn btn-info btn-sm">View</a>
                        @endcan

                        @can('update', $property)
                            <a href="{{ route('property.edit', $property->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endcan

                        @can('delete', $property)
                            <form action="{{ route('property.destroy', $property->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No properties found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
