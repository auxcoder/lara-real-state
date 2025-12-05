<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if (app()->getLocale() == 'ar') dir="rtl" @endif translate="no">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="The H Real Estate | Trusted UAE Property Experts">
    <title>The UX Real Estate</title>
    <link rel="canonical" href="https://real.uxcrafters.com/" />
    <meta name="description"
        content="Find your perfect property with The H Real Estate. Trusted UAE experts in residential, commercial, and luxury real estate solutions." />
    <meta name="keywords" content="" />
    @if (app()->getLocale() == 'ar')
    <meta name="direction" content="rtl">
    @endif
    <!-- Google tag (gtag.js) -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NHSHZHZEWD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-NHSHZHZEWD');
    </script>
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo-footer01.png') }}" alt="The H Real Estate Logo"
        title="Logo">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <!-- Bootstrap Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>

<body class="bg-light">
    <!-- Nav-Bar -->
    <header class="header">
        <nav class="navbar navbar-dark navbar-expand-lg">
            <div class="container d-block">
                <div class="row align-items-center">
                    <div class="col-md-2 col-6">
                        <a class="navbar-brand" href="/">
                            <img src="{{ asset('assets/img/logo-w.png') }}" alt="logo" class="logo" title="Logo">
                        </a>
                    </div>

                    <div class="col-md-8 col-lg-7 mob-1">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('aboutUs') }}">{{ __('About us') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    About
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                    <li><a class="dropdown-item" href="{{ route('aboutUs') }}">About</a></li>
                                    <li><a class="dropdown-item" href="{{ route('leadership') }}">Leaders</a></li>
                                </ul>
                            </li> --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="propertiesDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('Properties') }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="propertiesDropdown">
                                    <li><a class="dropdown-item"
                                            href="{{ route('properties.byLocation', 'Residential') }}">{{
                                            __('Residential') }}</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('properties.byLocation', 'Commercial') }}">{{
                                            __('Commercial') }}</a>
                                    </li>
                                    {{-- <li><a class="dropdown-item"
                                            href="{{ route('properties.byLocation', 'Off-Plan') }}">Off-Plan</a></li>
                                    --}}
                                    <li><a class="dropdown-item" href="{{ route('properties.byLocation', 'Mall') }}">{{
                                            __('Mall') }}</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('properties.byLocation', 'Villa') }}">{{
                                            __('Villa') }}</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('service') }}">{{ __('Services') }}</a>
                            </li>

                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ url('blog') }}">{{ __('Blogs') }}</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('Contact us') }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                    <li><a class="dropdown-item" href="{{ route('contactUs') }}">{{ __('Contact us')
                                            }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('complaint.form') }}">{{ __('Complaint
                                            Form') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('visitor.form') }}">{{ __('Visitor
                                            Form') }}</a></li>
                                    <li><a class="dropdown-item" href="{{ route('registration.form') }}">{{ __('Register
                                            as vendor') }}
                                        </a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('complain') }}">Complaint</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('visitor') }}">Visitor</a>
                            </li> --}}
                        </ul>
                    </div>
                    {{-- <div class="col-md-2 col-lg-3 mob-1">
                        <a class="nav-link btn10" href="{{ route('login') }}">{{ __('Login') }}</a>
                        <div class="d-inline ms-2">
                            <a href="{{ route('lang.switch', 'en') }}">EN</a> |
                            <a href="{{ route('lang.switch', 'ar') }}">ع</a>
                        </div>
                    </div> --}}
                    <div class="col-6 col-md-10 d-lg-none d-md-block">
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#navbarOffcanvas" aria-controls="navbarOffcanvas" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="offcanvas offcanvas-end bg-secondary secondary-1" id="navbarOffcanvas" tabindex="-1"
                            aria-labelledby="offcanvasNavbarLabel">
                            <div class="offcanvas-header">
                                <a class="navbar-brand" href="/"><img src="{{ asset('assets/img/image 10.png') }}"
                                        alt="logo" class="logo"></a>
                                <button type="button" class="btn-close btn-close-white text-reset"
                                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                                    </li>

                                    {{-- <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            About
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                            <li><a class="dropdown-item" href="{{ route('aboutUs') }}">About</a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{ route('leadership') }}">Leaders</a>
                                            </li>
                                        </ul>
                                    </li> --}}

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="propertiesDropdown"
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Properties
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="propertiesDropdown">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('properties.byLocation', 'Residential') }}">Residential</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('properties.byLocation', 'Commercial') }}">Commercial</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('properties.byLocation', 'Mall') }}">Mall</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('properties.byLocation', 'Villa') }}">Villa</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('service') }}">Services</a>
                                    </li>

                                    {{-- <li class="nav-item">
                                        <a class="nav-link" href="{{ url('blog') }}">Blogs</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Contact Us
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                            <li><a class="dropdown-item" href="{{ route('contactUs') }}">Contact Us</a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{ url('complain') }}">Complaint</a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{ url('visitor') }}">Visitor</a></li>
                                        </ul>
                                    </li> --}}
                                    <li>
                                        <a class="nav-link btn10" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        <div class="d-inline ms-2">
                                            <a href="{{ route('lang.switch', 'en') }}">EN</a> |
                                            <a href="{{ route('lang.switch', 'ar') }}">ع</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section>
        <div class="sec-1 hero">
            <div class="row">
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

    <section>
        <div class="sec-2">
            <div class="container p-4 rounded-3 shadow bg-light">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="le5 d-flex gap-3 align-items-end mb-2">
                            <h2 class="le-title mb-0">{{ __('WHAT ARE YOU LOOKING FOR?') }}</h2>
                            {{-- <p class="card-text">{{ __('(Easily find the house of your choice)') }}</p> --}}
                        </div>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                    aria-selected="true">
                                    {{ __('Rent') }}
                                </button>
                            </li>
                            {{-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    {{ __('Buy') }}
                                </button>
                            </li> --}}
                        </ul>

                        <div class="mt-3">
                            <div class="tab-pane active" id="home">
                                <form method="GET" id="state-form"
                                    data-base-url="{{ route('properties.byLocation', ['location' => '__LOCATION__']) }}">
                                    {{-- @csrf --}}

                                    <select name="property_type" id="property_type" class="f1">
                                        <option value="" hidden>{{ __('Select Property Type') }}</option>
                                        <option value="Residential">{{ __('Residential') }}</option>
                                        <option value="Commercial">{{ __('Commercial') }}</option>
                                        <option value="Mall">{{ __('Mall') }}</option>
                                        <option value="Villa">{{ __('Villa') }}</option>
                                    </select>

                                    <select name="community" id="community" class="f2">
                                        <option value="" hidden>{{ __('City, Neighborhood, or Community') }}
                                        </option>
                                        <option value="Abu Dhabi">{{ __('Abu Dhabi') }}</option>
                                        <option value="Dubai">{{ __('Dubai') }}</option>
                                        <option value="Al Ain">{{ __('Al Ain') }}</option>
                                        <option value="Sharjah">{{ __('Sharjah') }}</option>
                                        <option value="Fujairah">{{ __('Fujairah') }}</option>
                                        <option value="Ras Al Khaimah">{{ __('Ras Al Khaimah') }}</option>
                                    </select>

                                    <button type="submit" class="button has-icon icon-send">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </form>

                            </div>
                            {{-- <div class="tab-pane" id="profile">
                                <form action="" id="state-form"></form>
                                <select class="f1">
                                    <option value="" hidden>{{ __('Select Property Type') }}</option>
                                    <option value="Residential" {{ old('property_type')=='Residential' ? 'selected' : ''
                                        }}>
                                        {{ __('Residential') }}
                                    </option>
                                    <option value="Commercial" {{ old('property_type')=='Commercial' ? 'selected' : ''
                                        }}>
                                        {{ __('Commercial') }}
                                    </option>
                                    <option value="Mall" {{ old('property_type')=='Mall' ? 'selected' : '' }}>
                                        {{ __('Mall') }}
                                    </option>
                                    <option value="Villa" {{ old('property_type')=='Villa' ? 'selected' : '' }}>
                                        {{ __('Villa') }}
                                    </option>
                                </select>

                                <select class="f2">
                                    <option value="">
                                        {{ __('City Neighborhood, Community') }}
                                    </option>
                                    <option value="">{{ __('City Neighborhood') }}</option>
                                </select>

                                <button class="button has-icon icon-send">
                                    <i class="bi bi-search"></i>
                                </button>
                                </form>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section>
        <div class="sec-3">
            <div class="container p-4 rounded-3 shadow">
                <div class="row">
                    <div class="col-md-12 me-auto text-center content1">
                        <h2>{{ __('Our properties') }}</h2>

                        <div class="owl-carousel service-carol owl-theme">
                            <div class="item">
                                <a href="{{ route('properties.byLocation', 'Abu Dhabi') }}">
                                    <img src="{{ asset('assets/img/Abu Dhabi.webp') }}" alt="Abu Dhabi"
                                        title="Abu Dhabi" />
                                    <h4>{{ __('Abu Dhabi') }}</h4>
                                </a>
                            </div>
                            <div class="item">
                                <a href="{{ route('properties.byLocation', 'Dubai') }}">
                                    <img src="{{ asset('assets/img/dubai.webp') }}" alt="Dubai" title="Dubai" />
                                    <h4>{{ __('Dubai') }}</h4>
                                </a>
                            </div>
                            <div class="item">
                                <a href="{{ route('properties.byLocation', 'Al Ain') }}">
                                    <img src="{{ asset('assets/img/Al Ain.webp') }}" alt="Al Ain" title="Al Ain" />
                                    <h4>{{ __('Al Ain') }}</h4>
                                </a>
                            </div>
                            <div class="item">
                                <a href="{{ route('properties.byLocation', 'Sharjah') }}">
                                    <img src="{{ asset('assets/img/Sharjah.webp') }}" alt="Sharjah" title="Sharjah" />
                                    <h4>{{ __('Sharjah') }}</h4>
                                </a>
                            </div>
                            <div class="item">
                                <a href="{{ route('properties.byLocation', 'Fujairah') }}">
                                    <img src="{{ asset('assets/img/Fujairah.webp') }}" alt="Fujairah"
                                        title="Fujairah" />
                                    <h4>{{ __('Fujairah') }}</h4>
                                </a>
                            </div>
                            <div class="item">
                                <a href="{{ route('properties.byLocation', 'Ras Al Khaimah') }}">
                                    <img src="{{ asset('assets/img/Ras Al Khaimah.webp') }}" alt="Ras Al Khaimah"
                                        title="Ras Al Khaimah" />
                                    <h4>{{ __('Ras Al Khaimah') }}</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- <section>
        <div class="sec-4">
            <div class="container p-4 rounded-3 shadow">
                <div class="row">
                    <div class="col-md-6">
                        <div class="le1">
                            <h2 class="le-title">New developments</h2>
                            <p class="card-text">
                                Take a look at new off-plan developments in and around Dubai
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="le2 align-items-center justify-content-end d-flex">
                            <a href="{{ route('offplan') }}">All Properties</a>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    @forelse ($developer_properties as $property)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $property->cover_image) }}" class="card-img-top"
                                alt="{{ $property->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $property->name }}</h5>
                                <p class="card-text">
                                    {{ $property->description }}
                                </p>
                                @if (!is_null($property->price))
                                <h6 class="price0">AED {{ number_format($property->price) }}</h6>
                                @else
                                <h6 class="price0">{{ __('properties.contact_for_price') }}</h6>
                                @endif
                                <div class="serv-icon mt-4">
                                    <i class="fa fa-bed"><span>Bed
                                            {{ $property->propertyTypes->first()->unit_type }}</span></i>
                                    <i class="fa fa-vector-square"><span>{{ $property->propertyTypes->first()->size }}
                                            sqft</span></i>
                                </div>
                                <div class="det d-flex align-items-center mt-4">
                                    <p>{{ $property->community_name->name ?? '' }} </p>
                                    <a href="{{ route('projects', $property->slug) }}">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center">
                        no property available
                    </p>
                    @endforelse

                </div>
            </div>
        </div>
    </section> --}}

    <!-- Sec 5 -->
    <section>
        <div class="sec-5 my-4">
            <div class="container p-4">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="le5">
                            <h2 class="le-title">{{ __('Browse by property type') }}</h2>
                            <p class="card-text">
                                {{ __('Handpicked projects for you') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 col-5">
                        {{-- <div class="le5 align-items-center justify-content-end d-flex">
                            <a href="">All Properties</a>
                        </div> --}}
                    </div>
                    {{-- {!! print_r($var, true) !!} --}}

                    <div class="d-flex justify-content-center">
                        <div class="owl-carousel type-carol owl-theme mt-4">
                            @foreach ($property_types as $type)
                            <div class="item">
                                <img class="rounded-3" src="{{ asset('assets/img/' . $type . '.webp') }}"
                                    alt="{{ $type }}" title="{{ $type }}" />
                                <a href="{{ route('properties.byLocation', $type) }}">
                                    <h4>{{ __( $type ) }}</h4>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- <section>
        <div class="sec-6">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="le6">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6">
                                    <div class="le-img">
                                        <img src="{{ asset('assets/img/prod01.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="le-conte">
                                        <h2>Buy your own</h2>
                                        <p>Apartments and villas.</p>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="le6">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6">
                                    <div class="le-img">
                                        <img src="{{ asset('assets/img/prod02.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="le-conte">
                                        <h2>Buy your own</h2>
                                        <p>Shops and warehouse.</p>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <div class="le6">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6">
                                    <div class="le-img">
                                        <img src="{{ asset('assets/img/prod-1.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="le-conte">
                                        <h2>Renting made easy</h2>
                                        <p>Rental Properties - in Al Fujairah, Al Raha Gradens, Baniyas, Al Garhoud.</p>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- <section>
        <div class="sec-7">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 me-auto text-center content2">
                        <h2>{{ __('Discover Modern New developments.') }}</h2>
                        <p>{{ __('Select your property type from our list of featured developers') }}</p>
                    </div>
                </div>
                <div class="owl-carousel logo-carol owl-theme mt-4">
                    <div class="item"><img src="{{ asset('assets/img/Aldar Logo.webp') }}" alt="Aldar Logo"
                            title="Aldar Logo"></div>
                    <div class="item"><img src="{{ asset('assets/img/Azizi Profile Logo.webp') }}" alt="Azizi Logo"
                            title="Azizi Logo"></div>
                    <div class="item"><img src="{{ asset('assets/img/Dubai properties Logo.webp') }}"
                            alt="Dubai Properties Logo" title="Dubai Properties Logo"></div>
                    <div class="item"><img src="{{ asset('assets/img/Ellington Logo.webp') }}" alt="Ellington Logo"
                            title="Ellington Logo">
                    </div>
                    <div class="item"><img src="{{ asset('assets/img/Emaar Properties Logo.webp') }}"
                            alt="Emaar Properties Logo" title="Emaar Properties Logo"></div>
                    <div class="item"><img src="{{ asset('assets/img/Meraas Logo.webp') }}" alt="Meraas Logo"
                            title="Meraas Logo"></div>
                    <div class="item"><img src="{{ asset('assets/img/logo03.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    @include('frontend.layout.footer')

</body>

<!-- JS Files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $('.service-carol').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        items: 3,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 6
            }
        }
    })
    $('.type-carol').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        items: 3,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 5
            }
        }
    })
</script>

<script>
    $('.logo-carol').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 3
            },
            600: {
                items: 3
            },
            1000: {
                items: 6
            }
        }
    });
</script>

<!-- Floating Buttons Container -->
<div class="floating-buttons position-fixed d-flex flex-column gap-2 z-3" style="bottom: 20px; right: 20px;">
    <!-- Visitor Button -->
    <div class="floating-button-container position-relative d-flex align-items-center ">
        <a href="{{ route('visitor.form') }}"
            class="btn btn-dark rounded-circle d-flex fs-4 align-items-center justify-content-center p-3"
            target="_blank">
            <i class="fas fa-plus text-white"></i>
        </a>
        <span
            class="tooltip-text roudnded-2 position-absolute bg-white text-dark fw-bold text-nowrap px-2 py-1 shadow-sm small">
            Add Record
        </span>
    </div>
</div>
<style>
    .tooltip-text {
        right: 60px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .floating-button-container:hover .tooltip-text {
        opacity: 1;
        visibility: visible;
    }
</style>
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

<!-- Font Awesome for Icons -->

</html>
