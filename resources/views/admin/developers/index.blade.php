@extends('admin.layout.master')

@section('content')
    <div class="container">
        <a href="{{ route('developers.create') }}" class="btn btn-primary mb-3">Add Developer</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Logo</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                                <img src="{{ asset('storage/' . $developer->logo) }}" alt="{{ $developer->name }} Logo" width="60" class="img-thumbnail">
                            @else
                                No Logo
                            @endif
                        </td>
                        <td>
                            @if ($developer->status == 'active')
                                <span class="badge bg-success">{{ ucfirst($developer->status) }}</span>
                            @else
                                <span class="badge bg-danger">{{ ucfirst($developer->status) }}</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('developers.show', $developer->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('developers.edit', $developer->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('developers.destroy', $developer->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No developers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
