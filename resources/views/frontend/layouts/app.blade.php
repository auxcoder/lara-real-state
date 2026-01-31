<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Properties</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo-countryside-fav.png') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
</head>

<body class="page-id-101 view-properties-page">
    @include('frontend.layout.header')

    <section>
        <div class="sec-02">
            @yield('content')
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
                    <a href="#"><img src="{{ asset('assets/img/logo-countryside-g.jpg') }}" alt=""></a>

                    <div class="mb-4 mt-4 foter-social-logo">
                        <a href="#"><i class="fa-facebook-square fab"></i></a>
                        <a href="#"><i class="fa-twitter-square fab"></i></a>
                        <a href="#"><i class="fa-instagram-square fab"></i></a>
                        <a href="#"><i class="fa-linkedin fab"></i></a>
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
            <div class="row d-flex align-items-center mt-4 ms-2">
                <div class="col-md-6">
                    <h2>{{ __('Newsletter To Get Updated the Latest News') }}</h2>
                </div>
                <div class="col-md-6">
                    <div class="d-flex gap-3">
                        <input type="email" placeholder="{{ __('notify.email_placeholder') }}" />
                        <button class="news__btn">{{ __('Subscribe Now') }}</button>
                    </div>
                </div>
            </div>


            <div class="row d-flex align-items-center mt-4 copyright">
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

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
