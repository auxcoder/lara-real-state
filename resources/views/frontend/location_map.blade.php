@extends('frontend.layouts.app')
@section('content')
    <div class="detail">
        <div class="row">
            <div class="col-md-12">
                <div class="payment-detail">
                    <h3>{{ $developer_property->name }}</h3>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $developer_property->locationMap) }}" class="img-fluid"
                            alt="{{ $developer_property->name }}">
                    </div>
                    <div class="col-md-6">
                        <p>{{ $developer_property->locationMap_description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
