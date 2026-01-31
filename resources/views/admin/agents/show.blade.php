@extends('admin.layout.master')

@section('content')
<div class="container">
    <h1>{{ $agent->name }}</h1>

    <div class="mb-3">
        <label>Email:</label>
        <p>{{ $agent->email }}</p>
    </div>

    <div class="mb-3">
        <label>Phone:</label>
        <p>{{ $agent->phone }}</p>
    </div>

    <div class="mb-3">
        <label>License Number:</label>
        <p>{{ $agent->license_number }}</p>
    </div>

    <div class="mb-3">
        <label>Bio:</label>
        <p>{{ $agent->bio }}</p>
    </div>

    <div class="mb-3">
        <label>Status:</label>
        <p>{{ ucfirst($agent->status) }}</p>
    </div>

    <div class="mb-3">
        <a href="{{ route('agents.index') }}" class="btn btn-secondary">Back</a>
        <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-primary">Edit</a>
    </div>
</div>
@endsection
