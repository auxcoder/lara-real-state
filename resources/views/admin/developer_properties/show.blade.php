@extends('admin.layout.master')

@section('content')
<div class="container">
    <h1>{{ $developer->name }}</h1>
    <p><strong>Email:</strong> {{ $developer->email }}</p>
    <p><strong>Phone:</strong> {{ $developer->phone }}</p>
    <p><strong>Status:</strong>
        @if ($developer->status == 'active')
            <span class="badge bg-success">{{ ucfirst($developer->status) }}</span>
        @else
            <span class="badge bg-danger">{{ ucfirst($developer->status) }}</span>
        @endif
    </p>
    <p><strong>Description:</strong> {{ $developer->description }}</p>

    @if ($developer->logo)
        <img src="{{ $developer->logo }}" alt="{{ $developer->name }} Logo" width="150" class="img-thumbnail">
    @else
        <p>No logo available.</p>
    @endif

    <a href="{{ route('developers.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
