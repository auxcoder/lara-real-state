@extends('frontend.layout.app')
@section('title', $property->title . ' | The H Real Estate UAE')
@section('description', 'View details of ' . $property->title . ' located in ' . $property->location . '. ' . \Illuminate\Support\Str::limit(strip_tags($property->description), 120))
@section('content')
    <!-- Bread Crumb -->
    <section class="sec-001 bread-crumb" style="background-image: url('{{ asset('storage/' . $property->image) }}');">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">{{ $property->title }}</h1>
                    <p class="text-center"><a href="/">Home</a> / <a href="#">{{ $property->title }}</a></p>
                </div>
            </div>
    </section>
    <!-- Bread Crumb End -->

    <!-- Sec 02 -->
    <section>
        <div class="sec-002">
            <div class="container">
                <div class="row mt-4">
                    <div class="col-md-8">
                        <div class="properies-detail-colum">
                            <img src="assets/img/detail-page-01.png" alt="">
                            <h4 class="mt-4">{{ $property->title }}</h4>
                            <p class="location-name"><i class="bi bi-pin-map"></i> {{ $property->location }}</p>
                            <div class="dt1">
                                @if ($property->bedrooms > 0)
                                    <i class="fa fa-bed"><span> Bed {{ $property->bedrooms }}</span></i>
                                @endif

                                @if ($property->bathrooms > 0)
                                    <i class="fa fa-bath"><span> Bath {{ $property->bathrooms }}</span></i>
                                @endif

                                <i class="fa fa-vector-square"><span> {{ $property->area }} sqft</span></i>
                            </div>
                            <p class="text-white">{!! $property->description !!}</p>
                            <h4 class="mt-4">Shop Details:</h4>
                            <ul class="property-details">
                                @if ($property->unit_area > 0)
                                    <li>
                                        <strong>Unit Area:</strong> {{ $property->unit_area }} Sq meter
                                    </li>
                                @endif

                                @if ($property->balcony_area > 0)
                                    <li>
                                        <strong>Balcony Area:</strong> {{ $property->balcony_area }} Sq meter
                                    </li>
                                @endif

                                @if ($property->utility_area > 0)
                                    <li>
                                        <strong>Utility Area:</strong> {{ $property->utility_area }} Sq meter
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="detail form-view-page">
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
                </div>
            </div>
        </div>

    </section>
    <!-- Sec 02 End-->

    <section>
        <div class="sec-003 sec-space">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-md-12">
                        <h2>Similar Properties</h2>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="property-box1">
                            <a href="{{ route('propertyDetails', $property->slug) }}"><img src="assets/img/similer-01.png"
                                    alt=""></a>
                            <h4 class="mt-4">Alpina house</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum urna vel velit
                                vestibulum, ac sag</p>
                            <h4 class="pro-price1">$140,500</h4>
                            <p class="location-name"><i class="bi bi-pin-map"></i> Al Jaddaf</p>
                            <div class="dt">
                                <i class="fa fa-bed"><span> Bed 4</span></i>
                                <i class="fa fa-bath"><span> Bath 2</span></i>
                                <i class="fa fa-vector-square"><span> 1500 sqft</span></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="property-box1">
                            <a href="{{ route('propertyDetails', $property->slug) }}"><img src="assets/img/similer-01.png"
                                    alt=""></a>
                            <h4 class="mt-4">Alpina house</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum urna vel velit
                                vestibulum, ac sag</p>
                            <h4 class="pro-price1">$140,500</h4>
                            <p class="location-name"><i class="bi bi-pin-map"></i> Al Jaddaf</p>
                            <div class="dt">
                                <i class="fa fa-bed"><span> Bed 4</span></i>
                                <i class="fa fa-bath"><span> Bath 2</span></i>
                                <i class="fa fa-vector-square"><span> 1500 sqft</span></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="property-box1">
                            <a href="{{ route('propertyDetails', $property->slug) }}"><img src="assets/img/similer-01.png"
                                    alt=""></a>
                            <h4 class="mt-4">Alpina house</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elementum urna vel velit
                                vestibulum, ac sag</p>
                            <h4 class="pro-price1">$140,500</h4>
                            <p class="location-name"><i class="bi bi-pin-map"></i> Al Jaddaf</p>
                            <div class="dt">
                                <i class="fa fa-bed"><span> Bed 4</span></i>
                                <i class="fa fa-bath"><span> Bath 2</span></i>
                                <i class="fa fa-vector-square"><span> 1500 sqft</span></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Sec 03 End-->

    <!-- Logo Carousel Start -->
    <section>
        <div class="sec-7">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 me-auto text-center content2">
                        <h2>Discover Modern New developments.</h2>
                        <p>Select your property type from our list of featured developers</p>
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
