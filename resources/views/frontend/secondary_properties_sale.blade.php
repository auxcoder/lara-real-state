@extends('frontend.layout.app')
@section('title', 'Properties For Sale | The H Real Estate UAE')
@section('description', 'Browse our selection of properties for sale across UAE. Find your perfect home with competitive prices and excellent locations.')
@section('content')
    <!-- Bread Crumb -->
    <section class="sec-001 bread-crumb">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Properties For Sale</h1>
                    <p class="text-center"><a href="/">Home</a> / <a href="#">Properties For Sale</a></p>
                </div>
            </div>
    </section>
    <!-- Bread Crumb End -->

    <section class="sec-sale-001 sec-space">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="search-form">
                        <div class="detail">
                            <h3>Search</h4>
                                <form>
                                    <ul class="form-style-1">
                                        <li>
                                            <input type="text" placeholder="Buy" name="field3" class="field-long" />
                                        </li>
                                        <li>
                                            <input type="text" placeholder="Property Type" name="field3"
                                                class="field-long" />
                                        </li>
                                        <li>
                                            <input type="text" placeholder="Type to Search...." name="field3"
                                                class="field-long" />
                                        </li>
                                        <li>
                                            <input type="submit" value="Search" />
                                        </li>
                                    </ul>
                                </form>
                        </div>
                    </div>
                    <div class="detail">
                        <h3>Get in Touch</h4>
                            <form>
                                <ul class="form-style-1">
                                    <li><label>Full Name <span class="required">*</span></label><input type="text"
                                            name="field1" class="field-divided" placeholder="First" /> <input
                                            type="text" name="field2" class="field-divided" placeholder="Last" />
                                    </li>
                                    <li>
                                        <label>Email <span class="required">*</span></label>
                                        <input type="email" name="field3" class="field-long" />
                                    </li>
                                    <li>
                                        <label>Subject</label>
                                        <select name="field4" class="field-select">
                                            <option value="Advertise">Advertise</option>
                                            <option value="Partnership">Partnership</option>
                                            <option value="General Question">General</option>
                                        </select>
                                    </li>
                                    <li>
                                        <label>Your Message <span class="required">*</span></label>
                                        <textarea name="field5" id="field5" class="field-long field-textarea"></textarea>
                                    </li>
                                    <li>
                                        <input type="submit" value="Submit" />
                                    </li>
                                </ul>
                            </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="properties-sale">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="ico-text">
                                    <h2>For Sale</h2>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <a class="btn10" href="#">Sort By</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        @forelse ($properties as $property)
                            <div class="col-md-6">
                                <div class="property-box1">
                                    <a href="{{ route('propertyDetails', $property->slug) }}"><img
                                            src="{{ asset('storage/' .$property->image) }}" alt=""></a>
                                    <h4 class="mt-4">{{ $property->title }}</h4>
                                    <p>{{ $property->description }}</p>
                                    @if (!is_null($property->price))
                                        <h4 class="pro-price1">AED {{ number_format($property->price) }}</h4>
                                    @else
                                        <h4 class="pro-price1">{{ __('properties.contact_for_price') }}</h4>
                                    @endif
                                    <p class="location-name"><i class="bi bi-pin-map"></i> {{ $property->location }}</p>
                                    <div class="dt">
                                        <i class="fa fa-bed"><span> Bed {{ $property->bedrooms }} </span></i>
                                        <i class="fa fa-bath"><span> Bath {{ $property->bathrooms }} </span></i>
                                        <i class="fa fa-vector-square"><span> {{ $property->area }} sqft</span></i>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <p class="text-center">
                                No properties found
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Logo Carousel Start -->
    <section>
        <div class="sec-7">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 me-auto text-center content2">
                        <h2>Discover Modern New developments.</h2>
                        <p>
                            Select your property type from our list of featured developers
                        </p>
                    </div>
                </div>
                <div class="owl-carousel logo-carol owl-theme mt-4">
                    <div class="item"><img src="{{ asset('assets/img/logo01.png') }}" alt="" /></div>
                    <div class="item"><img src="{{ asset('assets/img/logo02.png') }}" alt="" /></div>
                    <div class="item"><img src="{{ asset('assets/img/logo03.png') }}" alt="" /></div>
                    <div class="item"><img src="{{ asset('assets/img/logo04.png') }}" alt="" /></div>
                    <div class="item"><img src="{{ asset('assets/img/logo01.png') }}" alt="" /></div>
                    <div class="item"><img src="{{ asset('assets/img/logo02.png') }}" alt="" /></div>
                    <div class="item"><img src="{{ asset('assets/img/logo03.png') }}" alt="" /></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Logo Carousel End -->
@endsection
