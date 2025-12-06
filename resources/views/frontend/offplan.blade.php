@extends('frontend.layout.app')

@php
$metaTitle = 'Properties | The H Real Estate UAE';
$metaDescription = 'Explore our comprehensive collection of properties across UAE. Find residential, commercial, and
luxury properties that match your requirements.';

if (isset($location)) {
    switch ($location) {
        case 'Residential':
        $metaTitle = 'Residential Properties | The H Real Estate UAE';
        $metaDescription = 'Explore luxury and affordable residential properties in the UAE with The H Real Estate. Find the
        perfect home tailored to your lifestyle.';
        break;
    case 'Commercial':
        $metaTitle = 'Commercial Properties | The H Real Estate UAE';
        $metaDescription = 'Invest in UAE\'s best commercial properties with The H Real Estate. Offices, retail, and business
        spaces designed for growth and success.';
        break;
    case 'Mall':
        $metaTitle = 'Mall Properties | The H Real Estate UAE';
        $metaDescription = 'Discover prime mall spaces across the UAE. The H Real Estate connects you with premium retail
        opportunities in vibrant shopping destinations.';
    break;
        case 'Villa':
        $metaTitle = 'Villas in UAE | The H Real Estate Experts';
        $metaDescription = 'Luxury villas with modern design and comfort. The H Real Estate offers exclusive villa listings for
        families seeking elegance and space.';
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

<section class="bg-light">
    <div class="container my-5">
        <div class="row">
            <div class="col-md-3"
                <form id="filter-form" method="GET"
                    data-base-url="{{ route('properties.byLocation', ['location' => '__LOCATION__']) }}"
                    class="filter-form">
                    <div class="mb-3">
                        <label for="community" class="form-label">{{ __('filter.heading') }}</label>
                        <select id="community" name="community" class="form-select mb-1" >
                            {{-- <option selected>{{ __('filter.city') }}</option> --}}
                            <option selected value="Dubai" {{ request('city')=='Dubai' ? 'selected' : '' }}>
                                {{ __('filter.city.Dubai') }}</option>
                            <option value="Abu Dhabi" {{ request('city')=='Abu Dhabi' ? 'selected' : '' }}>
                                {{ __('filter.city.AbuDhabi') }}</option>
                            <option value="Sharjah" {{ request('city')=='Sharjah' ? 'selected' : '' }}>
                                {{ __('filter.city.Sharjah') }}</option>
                            <option value="Al Ain" {{ request('city')=='Al Ain' ? 'selected' : '' }}>
                                {{ __('filter.city.AlAin') }}</option>
                            <option value="Fujairah" {{ request('city')=='Fujairah' ? 'selected' : '' }}>
                                {{ __('filter.city.Fujairah') }}</option>
                            <option value="Ras Al Khaimah" {{ request('city')=='Ras Al Khaimah' ? 'selected' : '' }}>
                                {{ __('filter.city.RAK') }}</option>
                        </select>

                        <select id="property_type" name="property_type" class="form-select" >
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

                    <div class="mb-3">
                        <label for="community" class="form-label">{{ __('status') }}</label>
                        <select id="status" name="status" class="form-select" >
                            <option disabled selected>{{ __('filter.status.select') }}</option>
                            <option value="sold" {{ request('status')=='sold' ? 'selected' : '' }}>
                                {{ __('filter.status.sold') }}</option>
                            <option value="available" {{ request('status')=='available' ? 'selected' : '' }}>
                                {{ __('filter.status.available') }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        {{ __('filter.button.search') }}
                    </button>
                </form>
            </div>

            <div class="col-md-9">
                @if (isset($location))
                <form method="GET" action="{{ route('properties.byLocation', $location) }}" class="search-form d-flex gap-2">
                    <select name="sort" onchange="this.form.submit()" class="form-select w-25 form-select-sm">
                        <option value="">{{ __('sort.heading') }}</option>
                        <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>
                            {{ __('sort.newest') }}
                        </option>
                        <option value="oldest" {{ request('sort')=='oldest' ? 'selected' : '' }}>
                            {{ __('sort.oldest') }}
                        </option>
                        <option value="price_high_to_low" {{ request('sort')=='price_high_to_low' ? 'selected' : ''
                            }}>
                            {{ __('sort.price_high_to_low') }}
                        </option>
                        <option value="price_low_to_high" {{ request('sort')=='price_low_to_high' ? 'selected' : ''
                            }}>
                            {{ __('sort.price_low_to_high') }}
                        </option>
                    </select>

                    <input class="w-75" type="text" placeholder="{{ '    ' . __('sort.search_placeholder') }}" />
                </form>
                @endif

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
                    <i class="fa-solid fa-location-dot"></i>
                    <h4 class="property-price">{{ $project->location }}</h4>

                    @if ($project->bedrooms > 0)
                    <div class="icons">
                        {{-- <img src="{{ asset('/assets/images/projects/icon.png') }}" /> --}}
                        {{-- <img src="{{ asset('/assets/images/projects/bed.png') }}" /> --}}
                        <i class="fa-solid fa-bed"></i>
                        {{ $project->bedrooms }}

                    </div>
                    @endif

                    @if ($project->bathrooms > 0)
                    <div class="icons">
                        {{-- <img src="{{ asset('/assets/images/projects/icon.png') }}" /> --}}
                        {{-- <img src="{{ asset('/assets/images/projects/bathtub.png') }}" /> --}}
                        <i class="fa-solid fa-bath"></i>
                        {{ $project->bathrooms }}
                    </div>
                    @endif
                </div>

                <a href="{{ route('projects', $project->slug) }}" class="viewdetails-btn mb-3 text-white">
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

       <div class="my-3 shadow-sm">
            <x-subscribe-signup />
        </div>
    </div>
</section>
<script>
    document.getElementById('filter-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const type = document.getElementById('property_type').value || '';
        const city = document.getElementById('community').value || '';
        const status = document.getElementById('status')?.value || ''; // if you have a status filter

        // Use city first, then type, as the __LOCATION__ placeholder
        const mainFilter = city || type;

        if (!mainFilter) {
            return alert('Please select at least a city or a property type.');
        }

        // Get base URL from Blade
        const template = this.dataset.baseUrl;
        let actionUrl = template.replace('__LOCATION__', encodeURIComponent(mainFilter));

        // Build query string only with non-empty filters
        const params = new URLSearchParams();
        if (city) params.append('city', city);
        // alert('City: ' + city);
        if (type) params.append('property_type', type);
        if (status) params.append('status', status);

        if (params.toString()) {
            actionUrl += '?' + params.toString();
        }

        this.action = actionUrl;
        this.submit();
    });
</script>
@endsection
