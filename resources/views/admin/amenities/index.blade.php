@extends('admin.layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Amenity List</h1>

            <a href="{{ route('amenity.create') }}" class="btn btn-primary mb-3">Add Amenity</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Logo</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Amenity as $amenity)
                        <tr>
                            <td>{{ $amenity->id }}</td>
                            <td>{{ $amenity->name }}</td>
                            <td><img src="{{ asset('storage/' . $amenity->logo) }}" width="50" height="50"></td>
                            <td>{{ $amenity->description }}</td>
                            <td>
                                <a href="{{ route('Amenity.edit', $amenity->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('Amenity.destroy', $amenity->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                <a href="{{ route('Amenity.show', $amenity->id) }}"
                                    class="btn btn-info btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
