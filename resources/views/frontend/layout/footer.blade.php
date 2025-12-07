<style>
    /* Hide Google Translate header */
    #\:2\.container {
        display: none !important;
    }

    #\:0\.container {
        display: none !important;
    }

    #\:1\.container {
        display: none !important;
    }

    .goog-te-gadget-icon {
        display: none !important;
    }
</style>

<footer class="mb-4 container">
    <div class="row rounded-3 bg-dark-subtle p-3">
        <div class="col-md-3">
            <h4>{{ __('Quick links') }}</h4>
            <ul class="list-unstyled mb-0 small">
                <li><a href="{{ route('properties.byLocation', 'Villa') }}"><i class="bi bi-arrow-right-short"></i>{{ __('Villa') }}</a></li>
                <li><a href="{{ route('service') }}"><i class="bi bi-arrow-right-short"></i>{{ __('Services') }}</a></li>
            </ul>
        </div>

        <div class="col-md-3">
            <h4>{{ __('Get In Touch') }}</h4>
            <ul class="list-unstyled mb-0 small">
                <li>
                    <a href="https://www.google.com/maps/dir/?api=1&destination=" target="_blank" rel="noopener noreferrer">
                        <i class="bi bi-geo-alt-fill"></i>
                        {{ __('Subscribe Now') }}
                    </a>
                </li>
                <li><a href="tel:022222040"><i class="bi bi-telephone-outbound-fill"></i> 022222040</a></li>
                <li><a href="mailto:auxcoder@gmail.com"><i class="bi bi-envelope"></i> auxcoder@gmail.com</a></li>
            </ul>
        </div>

        <div class="col-md-3">
            <h4>{{ __('Contact us') }}</h4>
            <ul class="list-unstyled mb-0 small">
                <li><a href="{{ route('contactUs') }}"><i class="bi bi-arrow-right-short"></i>{{ __('Contact us')}}</a></li>
                <li><a href="{{ route('complaint.form') }}"><i class="bi bi-arrow-right-short"></i>{{ __('Complaint Form') }}</a></li>
                <li><a href="{{ route('visitor.form') }}"><i class="bi bi-arrow-right-short"></i>{{ __('Visitor Form') }}</a></li>
            </ul>
        </div>
    </div>

    {{-- <div class="row mt-4 d-flex align-items-center ms-2">
        <div class="col-md-6">
            <h2>{{ __('Newsletter To Get Updated the Latest News') }}</h2>
        </div>
        <div class="col-md-6">
            <div class="d-flex gap-3">
                <input type="email" placeholder="{{ __('notify.email_placeholder') }}" />
                <button class="news__btn">{{ __('Subscribe Now') }}</button>
            </div>
        </div>
    </div> --}}

    <div class="row d-flex align-items-center mt-3 small">
        <div class="col-md-6">
            {{ __('Copyright © 2025, All rights reserved.') }}
        </div>

        <div class="col-md-6 text-end">
            <ul class="list-unstyled mb-0">
                <li class="list-inline-item"><a href="{{ route('term-condition') }}">{{ __('Terms of Service')
                        }}</a></li>
                <li class="list-inline-item"><a href="{{ route('privacy-policy') }}">{{ __('Privacy Policy') }}</a>
                </li>
                <li class="list-inline-item"><a href="#">{{ __('Cookies') }}</a></li>
            </ul>
        </div>
    </div>
</footer>
