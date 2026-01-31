@extends('frontend.layout.app')
@section('title', 'Contact The H Real Estate | UAE Property Experts')
@section('description', 'Get in touch with The H Real Estate for trusted property guidance. Reach us for residential, commercial, and luxury real estate solutions.')
@section('content')
@if (app()->getLocale() == 'ar')
    <style>
        .contact-form input,
        .contact-form textarea {
            direction: rtl !important;
            /* ensure browser lays out placeholder RTL */
            text-align: right !important;
            /* ensure both placeholder & user text align right */
        }

        .about-3 form input {
            direction: rtl !important;
            text-align: right !important;
        }
    </style>
@endif
<section class="contact-banner">
    <div class="container">
        <h2 class="serviceh2">{{ __('Contact us') }}</h2>
        <p class="banner-p">
            {{ __('We are a full-service real estate company in UAE that is able to assist you with all your real estate needs.') }}
        </p>
    </div>
</section>

<section class="">
    <div class="container">
        <div class="contact-main">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="contact1a">{{ __('h_real_estate') }}</h4>
                    <p class="contact1b">Khalifa Park Area - Zone 1 - Ministries Complex - Abu Dhabi</p>
                    <div class="call">
                        <i class="fa-phone fa-solid"></i>
                        <a href="#">022222040</a>
                    </div>
                    <div class="call">
                        <i class="fa-envelope fa-solid"></i>
                        <a href="#">info@thehr.ae</a>
                    </div>
                    <p class="contact1c">
                        {{ __('If you have any queries or you would like us to meet and discuss them, just fill in the form and we will get back to you.') }}
                    </p>
                </div>
                <div class="col-md-6">

                    <form class="contact-form" method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" placeholder="{{ '    ' . __('Your Name') }}" name="name"
                                    required />
                            </div>
                            <div class="col-md-6 mob-input">
                                <input type="email" placeholder="{{ __('Your Email') }}" name="email" required />
                            </div>
                            <div class="col-md-12 mt-3">
                                <input type="number" placeholder="{{ '    ' . __('Your Phone') }}" name="phone"
                                    required />
                            </div>
                            <div class="col-md-12 mt-3">
                                <textarea rows="6" placeholder="{{ '  ' . __('Message') }}" name="message"></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit">{{ __('Submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="about-3">
            {{-- <div class="container">
                <h3 class="about3a">{{ __('Be the first to know.') }}</h3>
                <p class="about3b">
                    {{ __('We invite you to register below and we’ll be in touch with exclusive updates and announcements about pre-leasing opportunities.') }}
                </p>
                <form dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                    <input type="email" placeholder="{{ __('notify.email_placeholder') }}" name="email" />
                    <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </div> --}}
        </div>
    </div>
</section>
@endsection
