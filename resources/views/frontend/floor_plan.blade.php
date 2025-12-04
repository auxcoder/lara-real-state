@extends('frontend.layouts.app')
@section('content')
    <div class="detail">
        <div class="row">
            <div class="col-md-12">
                <div class="payment-detail">
                    <h3>{{ $developer_property->name }}</h3>
                    <p>{{ $developer_property->floorPlan_description }} </p>
                </div>
            </div>
        </div>
    </div>

    <div class="detail">
        <div class="row">
            <div class="col-md-12">
                <div class="floor-plan-main">
                    <div class="download">
                        <a href="#">Download</a>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-4">
                            <div class="input-wrap">
                                <div class="filter-label">
                                    <label>Property Type</label>
                                </div>

                                <select id="PropertyTypeId">
                                    <option value="0" selected="selected">All</option>
                                    <option value="Apartment">Apartment</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-wrap">
                                <div class="filter-label">
                                    <label>Category</label>
                                </div>

                                <select id="PropertyTypeId">
                                    <option value="0" selected="selected">All</option>
                                    <option value="Apartment">Apartment</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="input-wrap">
                                <div class="filter-label">
                                    <label>Unit Type</label>
                                </div>

                                <select id="PropertyTypeId">
                                    <option value="0" selected="selected">All</option>
                                    <option value="Apartment">Apartment</option>
                                </select>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="floor-plan mt-5">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Floor Plan</th>
                                <th>Category</th>
                                <th>Type</th>
                                {{-- <th>Sizes</th> --}}
                                <th>Floor Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($developer_property->floorPlans as $floorPlan)
                                <tr>
                                    {{-- <td><img src="{{ $floorPlan->image}}"
                                                                    alt=""></td> --}}
                                    <td><img src="{{ asset('storage/' . $floorPlan->image) }}" alt=""></td>
                                    <td>{{ $floorPlan->category }}</td>
                                    <td>{{ $floorPlan->unit_type }}</td>
                                    <td>{{ $floorPlan->floor_details }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <p>no floor plans available</p>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
