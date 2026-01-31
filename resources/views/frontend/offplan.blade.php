@extends('frontend.layout.app')

@php
$companyName = config('company.name');
$metaTitle = "Properties | {$companyName}";
$metaDescription = 'Explore our comprehensive collection of properties en toda España. Find residential, commercial, and luxury properties that match your requirements.';

if (isset($location)) {
    switch ($location) {
        case 'Residential':
        $metaTitle = "Residential Properties | {$companyName}";
        $metaDescription = "Explore luxury and affordable residential properties in España con {$companyName}. Find the perfect home tailored to your lifestyle.";
        break;
    case 'Commercial':
        $metaTitle = "Commercial Properties | {$companyName}";
        $metaDescription = "Invest in España's best commercial properties with {$companyName}. Offices, retail, and business spaces designed for growth and success.";
        break;
    case 'Mall':
        $metaTitle = "Mall Properties | {$companyName}";
        $metaDescription = "Discover prime mall spaces across España. {$companyName} connects you with premium retail opportunities in vibrant shopping destinations.";
    break;
        case 'Villa':
        $metaTitle = "Villas en España | {$companyName}";
        $metaDescription = "Luxury villas with modern design and comfort. {$companyName} offers exclusive villa listings for families seeking elegance and space.";
        break;
    }
}
@endphp

@section('title', $metaTitle)
@section('description', $metaDescription)

@section('content')
<section class="cover-image-banner" style="background-image: url('{{ asset("assets/images/$bannerImage") }}');">
    <div class="container py-5 text-white">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">
                    {{ __('propdetails.banner.title', ['location' => $locationName ?? ($location ?? '')]) }}
                </h1>
                <p class="text-center"><a href="/" class="text-white">{{ __('Home') }}</a> / <span>{{ $locationName }}</span></p>
            </div>
        </div>
    </div>
</section>

<section class="my-3">
    <div class="container">
        <div class="row p-3 bg-light rounded-3">
            <div class="col-md-3 <form id="filter-form" method="GET"
                    data-base-url="{{ route('properties.byLocation', ['location' => '__LOCATION__']) }}"
                    class="filter-form">
                    <div class="mb-2">
                        <label for="community" class="form-label">{{ __('filter.heading') }}</label>
                        <select id="community" name="community" class="mb-1 form-select form-select-sm" >
                            @foreach ($communities as $community)
                            <option value="$community->slug" {{ request('location') == $community->slug? 'selected' : '' }}>{{ $community->name }}</option>
                            @endforeach
                        </select>

                        <select id="property_type" name="property_type" class="form-select form-select-sm">
                            <option disabled selected>{{ __('filter.property_type') }}</option>
                            <option value="Residential" {{ request('property_type')=='Residential' ? 'selected' : '' }}>
                                {{ __('filter.property_type.Residential') }}</option>
                            <option value="Commercial" {{ request('property_type')=='Commercial' ? 'selected' : '' }}>
                                {{ __('filter.property_type.Commercial') }}</option>
                            <option value="Mall" {{ request('property_type')=='Mall' ? 'selected' : '' }}>
                                {{ __('filter.property_type.Mall') }}</option>
                            <option value="Villa" {{ request('property_type')=='Villa' ? 'selected' : '' }}>
                                {{ __('filter.property_type.Villa') }}</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="status" class="form-label">{{ __('status') }}</label>
                        <select id="status" name="status" class="form-select form-select-sm">
                            <option disabled selected>{{ __('filter.status.select') }}</option>
                            <option value="sold" {{ request('status')=='sold' ? 'selected' : '' }}>{{ __('filter.status.sold') }}</option>
                            <option value="available" {{ request('status')=='available' ? 'selected' : '' }}>{{ __('filter.status.available') }}</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm">
                        {{ __('filter.button.search') }}
                    </button>
                </form>
            </div>

            <div class="col-md-9">
                @if (isset($location))
                <div class="d-flex gap-2 search-form mb-3">
                    <select name="sort" 
                            class="w-25 form-select form-select-sm"
                            hx-get="{{ route('properties.byLocation', $location) }}"
                            hx-trigger="change"
                            hx-target="#property-list"
                            hx-indicator="#sort-spinner">
                        <option value="">{{ __('sort.heading') }}</option>
                        <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>
                            {{ __('sort.newest') }}
                        </option>
                        <option value="oldest" {{ request('sort')=='oldest' ? 'selected' : '' }}>
                            {{ __('sort.oldest') }}
                        </option>
                        <option value="price_high_to_low" {{ request('sort')=='price_high_to_low' ? 'selected' : '' }}>
                            {{ __('sort.price_high_to_low') }}
                        </option>
                        <option value="price_low_to_high" {{ request('sort')=='price_low_to_high' ? 'selected' : '' }}>
                            {{ __('sort.price_low_to_high') }}
                        </option>
                    </select>
                    <span id="sort-spinner" class="htmx-indicator spinner-border spinner-border-sm"></span>
                </div>
                @endif

                <div id="property-list">
                @forelse ($properties as $project)
                <img src="{{ asset('storage/' . $project->main_image) }}" class="property-image" />

                @if (!is_null($project->price))
                    <h4 class="">AED {{ number_format($project->price) }}</h4>
                @else
                    <h4 class="">{{ __('properties.contact_for_price') }}</h4>
                @endif

                <p class="property-det" style="color: white;   "></p>

                <div class="details">
                    {{-- <img src="{{ asset('/assets/images/projects/location.png') }}" width="30" /> --}}
                    <i class="fa-location-dot fa-solid"></i>
                    <h4 class="property-price">{{ $project->location }}</h4>

                    @if ($project->bedrooms > 0)
                    <div class="icons">
                        {{-- <img src="{{ asset('/assets/images/projects/icon.png') }}" /> --}}
                        {{-- <img src="{{ asset('/assets/images/projects/bed.png') }}" /> --}}
                        <i class="fa-bed fa-solid"></i>
                        {{ $project->bedrooms }}

                    </div>
                    @endif

                    @if ($project->bathrooms > 0)
                    <div class="icons">
                        {{-- <img src="{{ asset('/assets/images/projects/icon.png') }}" /> --}}
                        {{-- <img src="{{ asset('/assets/images/projects/bathtub.png') }}" /> --}}
                        <i class="fa-bath fa-solid"></i>
                        {{ $project->bathrooms }}
                    </div>
                    @endif
                </div>

                <a href="{{ route('projects', $project->slug) }}" class="mb-3 text-white viewdetails-btn">
                    {{ __('filter.button.details') }}
                </a>

                <hr>

                @empty

                <div class="my-3">
                    <p>{{ __('projects.none') }}</p>
                </div>

                @endforelse
                </div>
            </div>
        </div>

       <div class="my-3 shadow-sm">
            <x-subscribe-signup />
        </div>
    </div>
</section>

@endsection
