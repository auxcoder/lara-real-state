@extends('frontend.layout.app')

@section('content')
<section>
    <div class="hero cover-image-banner py-5">
        <div class="row py-5">
            <div class="container">
                <div class="col-lg-8">
                    <h1>{{ __('Modern Apartments Exclusive Listing') }}</h1>
                    <p>
                        {{ __('Get the features you in all the property we offer at the best price you can get') }}
                    </p>
                </div>

                {{-- <div class="social-link mob-1 social @if (app()->getLocale() == 'ar') arb @endif"> --}}
                    {{-- <a href="https://www.facebook.com/thehr.ae/"><i class="bi bi-facebook"></i></a> --}}
                    {{-- <a href="https://x.com/TheHrealestate2"><i class="bi bi-twitter"></i></a> --}}
                    {{-- <a href="https://www.instagram.com/thehr.ae/"><i class="bi bi-instagram"></i></a> --}}
                    {{-- <a href="https://www.linkedin.com/company/the-h-real-estate/"><i
                            class="bi bi-linkedin"></i></a> --}}
                    {{-- <a href="https://www.youtube.com/channel/UC5LC_NCFImIkl0onSY65vXw"><i --}} {{--
                            class="bi bi-youtube"></i></a> --}}
                    {{-- </div> --}}
            </div>
        </div>
    </div>
</section>

<section class="mt-4" >
    <div class="container p-4 rounded-3 shadow bg-light">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex gap-3 align-items-end mb-2">
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
                    <div class="tab-pane active" id="home">
                        <form method="GET" id="state-form"
                            data-base-url="{{ route('properties.byLocation', ['location' => '__LOCATION__']) }}">
                            {{-- @csrf --}}

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
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-3">
    <div class="container p-4 rounded-3 shadow">
        <div class="row align-items-center">
            <div class="col-12">
                <h3 class="m-0 lh-1">{{ __('Popular Locations') }}</h3>
                <p class="card-text text-muted">
                    {{ __('Most popular properties locations') }}
                </p>
            </div>

            <div class="card-group mt-2">
                @foreach ($locations as $place)
                <div class="col card">
                    <img class="card-img-top" src="{{ asset('assets/img/' . $place . '.webp') }}" alt="{{ $place }} picture" title="{{ $place }}" />
                    <div class="card-body">
                        <a class="" href="{{ route('properties.byLocation', $place) }}">{{ __($place) }}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="my-4">
    <div class="container p-4 rounded-3 shadow">
        <div class="row align-items-center">
            <div class="col-12">
                <h3 class="m-0 lh-1">{{ __('Browse by property type') }}</h3>
                <p class="card-text text-muted">
                    {{ __('Handpicked projects for you') }}
                </p>
            </div>

            {{-- {!! print_r($var, true) !!} --}}

            <div class="card-group mt-2">
                @foreach ($property_types as $type)
                <div class="card">
                    <img class="card-img-top" src="{{ asset('assets/img/' . $type . '.webp') }}" alt="{{ $type }}" title="{{ $type }}" />
                            <div class="card-footer">
                        <div class="item-thumb position-relative">
                            <a class="bg-dark w-100" href="{{ route('properties.byLocation', $type) }}">
                                <p class="m-0 px-2 py-1 w-100 text-center text-white" >{{ __( $type ) }}</p>
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

<script>
document.getElementById('state-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const type = document.getElementById('property_type').value;
    const place = document.getElementById('community').value;
    const filter = place || type;

    if (!filter) {
        return alert('Please select a property type or a location.');
    }

    // grab the Blade-generated template URL
    const template = this.dataset.baseUrl;
    // replace the placeholder with the real, encoded filter
    this.action = template.replace('__LOCATION__', encodeURIComponent(filter));
    this.submit();
});
</script>
@endsection
