@extends('admin.layout.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Amenity Details</h1>
            <div>
                <strong>Name:</strong> {{ $amenity->name }}
            </div>
            <div>
                <strong>Logo:</strong> <img src="{{ $amenity->logo }}" width="100" height="100">
            </div>
            <div>
                <strong>Description:</strong> {{ $amenity->description }}
            </div>
            <a href="{{ route('Amenity.index') }}" class="btn btn-primary mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection
