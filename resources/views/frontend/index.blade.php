@extends('frontend.layout.app')

@section('content')
<section class="">
    <div class="py-5 cover-image-banner hero">
        <div class="row py-5">
            <div class="container">
                <div class="col-lg-8">
                    <h1>{{ __('Modern Apartments Exclusive Listing') }}</h1>
                    <p>{{ __('Get the features you in all the property we offer at the best price you can get') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-4" >
    <div class="container p-4 bg-light rounded-3 shadow">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex align-items-end mb-2 gap-3">
                    <h2 class="mb-0">{{ __('WHAT ARE YOU LOOKING FOR?') }}</h2>
                    {{-- <p class="card-text">{{ __('(Easily find the house of your choice)') }}</p> --}}
                </div>

                <ul class="nav nav-pills" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home" type="button" role="tab" aria-controls="home"
                            aria-selected="true">
                            {{ __('Rent') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">
                            {{ __('Buy') }}
                        </button>
                    </li>
                </ul>

                <div class="mt-3">
                    <div class="active tab-pane" id="home">
                        <form method="GET" action="{{ route('offplan') }}"
                              hx-get="{{ route('offplan') }}"
                              hx-target="#property-results"
                              hx-push-url="true"
                              hx-indicator="#search-spinner">
                            <div class="d-flex gap-2">
                                <select name="property_type" id="property_type" class="form-select">
                                    <option value="" hidden>{{ __('Select Property Type') }}</option>
                                    <option value="Residential">{{ __('Residential') }}</option>
                                    <option value="Commercial">{{ __('Commercial') }}</option>
                                    <option value="Mall">{{ __('Mall') }}</option>
                                    <option value="Villa">{{ __('Villa') }}</option>
                                </select>

                                <select name="community" id="community" class="form-select">
                                    <option value="" hidden>{{ __('City, Neighborhood, or Community') }}
                                    </option>
                                    <option value="Abu Dhabi">{{ __('Abu Dhabi') }}</option>
                                    <option value="Dubai">{{ __('Dubai') }}</option>
                                    <option value="Al Ain">{{ __('Al Ain') }}</option>
                                    <option value="Sharjah">{{ __('Sharjah') }}</option>
                                    <option value="Fujairah">{{ __('Fujairah') }}</option>
                                    <option value="Ras Al Khaimah">{{ __('Ras Al Khaimah') }}</option>
                                </select>
                                <button type="submit" class="btn btn-link">
                                    <i class="bi bi-search"></i>
                                    <span id="search-spinner" class="htmx-indicator spinner-border spinner-border-sm ms-1"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-4">
    <div class="container p-4 bg-light rounded-3 shadow">
        <div class="row align-items-center">
            <div class="col-12">
                <h3 class="m-0 lh-1">{{ __('Popular Locations') }}</h3>
                <p class="text-muted card-text">
                    {{ __('Most popular properties locations') }}
                </p>
            </div>

            <div class="row row-cols-1 row-cols-md-6 mt-1 g-1">
                @foreach ($communities as $community)
                <div class="col">
                    <div class="card h-100">
                        {{-- {!! print_r($community['slug'], true) !!} --}}

                        <a class="lh-sm small" href="{{ route('properties.byLocation', $community['slug']) }}">
                            <img class="card-img-top" src="{{ asset('assets/img/flags/' . $community['image']) }}"
                                alt="{{ $community['name'] }} flag" title="{{ $community['name'] }}" />
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="my-4">
    <div class="container p-4 bg-light rounded-3 shadow">
        <div class="row align-items-center">
            <div class="col-12">
                <h3 class="m-0 lh-1">{{ __('Browse by property type') }}</h3>
                <p class="text-muted card-text">
                    {{ __('Handpicked projects for you') }}
                </p>
            </div>

            <div class="mt-2 card-group">
                @foreach ($property_types as $type)
                <div class="card">
                    <img class="card-img-top" src="{{ asset('assets/img/' . $type . '.webp') }}" alt="{{ $type }}" title="{{ $type }}" />
                            <div class="card-footer">
                        <div class="position-relative item-thumb">
                            <a class="bg-dark w-100" href="{{ route('properties.byLocation', $type) }}">
                                <p class="m-0 px-2 py-1 text-center text-white w-100" >{{ __( $type ) }}</p>
                            </a>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- <x-floating-buttons /> --}}

@endsection
