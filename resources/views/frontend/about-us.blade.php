@extends('frontend.layout.app')
@section('title', 'About {{ config('company.name') }} | Inmobiliaria de Confianza en España')
@section('description', 'Learn more about {{ config('company.name') }}, a trusted name en España with years of experience in property solutions, project management, and client care.')
@section('content')
    <style>
        ul {
            /* color: white; */
        }
    </style>
    {{-- @if (app()->getLocale() == 'ar')
        <style>
            .banner {
                text-align: right !important;
            }
        </style>
    @endif --}}

    <section class="banner">
        <div class="container">
            <h1 class="bannerh2">{{ __('ABOUT US') }}</h1>
        </div>
    </section>

    <section class="">
        <div class="container-fluid">
            {{-- <div class="about1">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/images/about/about (7).jpg') }}" alt="about1" class="about1-img" />
                    </div>
                    <div class="col-md-6">
                        <p class="about1c">{{ __('intro') }}</p>
                    </div>
                </div>
            </div> --}}

            <div class="about2">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="about1b">{{ __('who_we_are_title') }}</h3>
                        <p class="about1c">{{ __('who_we_are_text') }}</p>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('assets/images/about/who we are.png') }}" alt="aboutus1" class="about2-img"
                            title="Who we are" />
                    </div>
                </div>
            </div>

            <div class="about1">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/images/about/our services includes.png') }}" alt="aboutus2"
                            title="Our Services" class="about1-img" />
                    </div>
                    <div class="col-md-6">
                        <h3 class="about1b">{{ __('services_title') }}</h3>
                        <ul>
                            <ul>
                                <li>{{ __('services_list.0') }}</li>
                                <li>{{ __('services_list.1') }}</li>
                                <li>{{ __('services_list.2') }}</li>
                                <li>{{ __('services_list.3') }}</li>
                                <li>{{ __('services_list.4') }}</li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="about2">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="about1b">{{ __('goal_title') }}</h3>
                        <p class="about1c">{{ __('goal_text') }}</p>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('assets/images/about/our goal.png') }}" alt="aboutus3" title="Our Goal"
                            class="about2-img" />
                    </div>
                </div>
            </div>

            <div class="about1">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/images/about/vision.png') }}" alt="aboutus4" title="Vision"
                            class="about1-img" />
                    </div>
                    <div class="col-md-6">
                        <h3 class="about1b">{{ __('vision_title') }}</h3>
                        <p class="about1c">{{ __('vision_text') }}</p>
                    </div>
                </div>
            </div>

            <div class="about2">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="about1b">{{ __('mission_title') }}</h3>
                        <p class="about1c">{{ __('mission_text') }}</p>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('assets/images/about/mission.png') }}" alt="aboutus5" title="Mission"
                            class="about2-img" />
                    </div>
                </div>
            </div>

            <div class="about1">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="{{ asset('assets/images/about/why choose us.png') }}" alt="aboutus6"
                            title="Why Choose Us" class="about1-img" />
                    </div>
                    <div class="col-md-6">
                        <h3 class="about1b">{{ __('why_choose_us_title') }}</h3>
                        <ul>
                            <li>{{ __('why_choose_us_list.0') }}</li>
                            <li>{{ __('why_choose_us_list.1') }}</li>
                            <li>{{ __('why_choose_us_list.2') }}</li>
                            <li>{{ __('why_choose_us_list.3') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="about-3">
                <div class="container">
                    <h3 class="about3a">{{ __('subscribe_title') }}</h3>
                    <p class="about3b">{{ __('subscribe_text') }}</p>
                    <form>
                        <input type="email" placeholder="{{ __('email_placeholder') }}" name="email" />
                        <button type="submit"><i class="fa-paper-plane fa-solid"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
