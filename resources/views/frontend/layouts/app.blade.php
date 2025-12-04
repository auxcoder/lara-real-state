<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Properties</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo-footer01.png') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <!-- Bootstrap Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>

<body class="view-properties-page page-id-101">
    <!-- Nav-Bar -->
    {{-- <header class="top-header mob-1">
        <nav class="navbar navbar-top">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-md-12 col-6">
                        <ul class="navbar-nav top-h1 me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('secondarySale') }}">Seconadry Properties</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('offplan') }}">Off Plan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('service') }}">Services</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header> --}}
    @include('frontend.layout.header')

    <section>
        <div class="sec-02">
            @yield('content')
            <div class="container">
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="row">

                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    {{-- @php
        $footerItems = app\Models\AgentProperty::where('developer_id', $developer_property->developer_id)
            ->latest()
            ->take(3)
            ->get();
    @endphp
    <section class="view-sec-02 sec-space">
        <div class="similer-vail mt-4">
            <div class="container">
                <h2>Similar Availabilities in Resale Property</h2>
                <div class="row mt-4">
                    @foreach ($footerItems as $footerItem)
                        <div class="col-md-4">
                            <div class="card1">
                                <img src="{{ asset('storage/' . $footerItem->cover_image) }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $footerItem->price }} AED</h5>
                                    <ul class="card-detail">
                                        <li>Bed
                                            {{ $footerItem->propertyTypes->first()->unit_type }}</li>
                                        <li>{{ $footerItem->community_name->name ?? '' }}</li>
                                        <li>{{ $footerItem->propertyTypes->first()->size }} Sq. Ft.</li>
                                    </ul>
                                    <a class="btn-detail1" href="{{ route('projects', $footerItem->slug) }}">View
                                        Deatils</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section> --}}



    <!-- Logo Carousel Start -->
    {{-- <section>
        <div class="sec-7">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 me-auto text-center content2">
                        <h2>Discover Modern New developments.</h2>
                        <p>Select your property type from our list of featured developers</p>
                    </div>
                </div>
                <div class="owl-carousel logo-carol owl-theme mt-4">
                    <div class="item"><img src="{{ asset('assets/img/logo01.png') }}" alt=""></div>
                    <div class="item"><img src="{{ asset('assets/img/logo02.png') }}" alt=""></div>
                    <div class="item"><img src="{{ asset('assets/img/logo03.png') }}" alt=""></div>
                    <div class="item"><img src="{{ asset('assets/img/logo04.png') }}" alt=""></div>
                    <div class="item"><img src="{{ asset('assets/img/logo01.png') }}" alt=""></div>
                    <div class="item"><img src="{{ asset('assets/img/logo02.png') }}" alt=""></div>
                    <div class="item"><img src="{{ asset('assets/img/logo03.png') }}" alt=""></div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Footer Start -->
    <footer id="footer">
        <div class="container">
            <div class="row ms-2">
                <div class="col-md-4">
                    <a href="#"><img src="{{ asset('assets/img/logo-footer01.png') }}" alt=""></a>
                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod nisi in nisi semper, vel
                        consectetur tellus ultricies.</p> --}}
                    <div class="foter-social-logo mt-4 mb-4">
                        <a href="#"><i class="fab fa-facebook-square"></i></a>
                        <a href="#"><i class="fab fa-twitter-square"></i></a>
                        <a href="#"><i class="fab fa-instagram-square"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h3>Get In Touch</h3>
                    <ul class="icon-text1">
                        <li><a href="#"><i class="bi bi-geo-alt-fill"></i>
                                <p>Khalifa Park Area - Zone 1 - Ministries Complex - Abu Dhabi</p>
                            </a></li>
                        <li><a href="tel:022222040"><i class="bi bi-telephone-outbound-fill"></i> 022222040</a></li>
                        <li><a href="mailto:info@thehr.ae"><i class="bi bi-envelope"></i> info@thehr.ae</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h3>Quick links</h3>
                    <ul>
                        <li><a href="#"><i class="bi bi-arrow-right-short"></i>Rentals</a></li>
                        <li><a href="#"><i class="bi bi-arrow-right-short"></i>Sales</a></li>
                        <li><a href="#"><i class="bi bi-arrow-right-short"></i>Apartments</a></li>
                        <li><a href="#"><i class="bi bi-arrow-right-short"></i>Industrial</a></li>
                        <li><a href="#"><i class="bi bi-arrow-right-short"></i>Offices</a></li>
                        <li><a href="#"><i class="bi bi-arrow-right-short"></i>Villas</a></li>
                        </ul0>
                </div>
                <div class="col-md-3">
                    <h3>Contact Us</h3>
                    <ul>
                        <li><a href="#"><i class="bi bi-arrow-right-short"></i>Contact us</a></li>
                        <li><a href="#"><i class="bi bi-arrow-right-short"></i>Survey</a></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4 d-flex align-items-center ms-2">
                <div class="col-md-6">
                    <h2>{{ __('Newsletter To Get Updated the Latest News') }}</h2>
                </div>
                <div class="col-md-6">
                    <div class="news__form">
                        <input type="email" placeholder="{{ __('notify.email_placeholder') }}" />
                        <button class="news__btn">{{ __('Subscribe Now') }}</button>
                    </div>
                </div>
            </div>
            <div class="row copyright d-flex align-items-center mt-4">
                <div class="col-md-6">
                    <p>Copyright © 2024, All rights reserved.</p>
                </div>
                <div class="col-md-6">
                    <ul class="footer-privacy">
                        <li><a href="{{ route('term-condition') }}">Terms of service</a></li>
                        <li><a href="{{ route('privacy-policy') }}">Privacy policy</a></li>
                        <li><a href="#">Cookies</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
