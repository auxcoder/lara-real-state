@extends('frontend.layout.app')

@section('title', 'Real Estate Services | The H Real Estate UAE')
@section('description', 'From buying and selling to project management, The H Real Estate provides professional, reliable services tailored to meet every client\'s needs.')

@section('content')
    <section class="service">
        <div class="text-center py-5">
            <h2 class="text-white">{{ __('Services') }}</h2>
            <p class="text-white">
                {{ __('We are a full-service real estate company in UAE that is able to assist you with all your real estate needs.') }}
            </p>
        </div>
    </section>

    <section class="">
        <div class="container">
            <div class="service1 d-flex justify-content-center">
                <div class="service-imgbox">
                    <a href="#">
                        <h3>{{ __('Property Management') }}</h3>
                        {{-- <p>{{ __('Experienced real estate professionals on our team can help you manage your properties efficiently.') }}</p> --}}
                    </a>
                </div>
                {{-- <div class="service-imgbox">
                    <a href="#">
                        <img src="{{ asset('assets/images/service/s2.png') }}" />
                        <h3>Real estate brokerage</h3>
                        <p>We connect buyers and sellers to help them achieve their real estate goals.</p>
                    </a>
                </div>
                <div class="service-imgbox">
                    <a href="#">
                        <img src="{{ asset('assets/images/service/s3.png') }}" />
                        <h3>Sales and rental services</h3>
                        <p>Our goal is to generate leads, close deals, and grow your business.</p>
                    </a>
                </div> --}}
                <div class="service-imgbox">
                    <a href="#">
                        <h3>{{ __('Facility Management') }}</h3>
                        {{-- <p>{{ __('What makes Property Angel the best NRI Property Management.') }}</p> --}}
                    </a>
                </div>
                {{-- <div class="service-imgbox">
                    <a href="#">
                        <img src="{{ asset('assets/images/service/s5.png' )}}" />
                        <h3>Angel Services</h3>
                        <p>provide more significant financial support.</p>
                    </a>
                </div> --}}
            </div>

            <div class="about-3">
                {{-- <div class="container">
                    <h3 class="about3a">{{ __('Be the first to know.') }}</h3>
                    <p class="about3b">
                        {{ __('We invite you to register below and we’ll be in touch with exclusive updates and announcements about pre-leasing opportunities.') }}
                    </p>
                    <form>
                        <input type="email" placeholder="{{ __('notify.email_placeholder') }}" name="email" />
                        <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                    </form>
                </div> --}}
            </div>
        </div>
    </section>
@endsection
