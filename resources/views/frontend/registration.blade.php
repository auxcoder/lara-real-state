@extends('frontend.layout.app')
@section('title', config('company.name') . ' | Registration Form')

@section('content')
<section class="cover-image-banner"
    style="background-image: url('{{ asset('assets/images/about/vendor banner.jpg') }}');">
    <div class="container py-5 text-white">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">{{ __('Register as vendor') }}</h1>
                <p class="text-center"><a href="/" class="text-white">{{ __('Home') }}</a> / <span class="text-white">{{ __('Register as vendor') }}</span>
            </div>
        </div>
</section>

<div class="container my-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">{{ __('Submit Your Information') }}</h3>

                    <form method="POST" action="{{ route('registration.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Name -->
                        <div class="row mb-3 form-group">
                            <label for="name"
                                class="col-form-label col-md-4 text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name" required
                                    autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3 form-group">
                            <label for="email"
                                class="col-form-label col-md-4 text-md-right">{{ __('Email') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="w-100 form-control @error('email') is-invalid @enderror" name="email"
                                    required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="row mb-3 form-group">
                            <label for="phone_number"
                                class="col-form-label col-md-4 text-md-right">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                                <input id="phone_number" type="tel"
                                    class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                    required>
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Trade License (File Upload) -->
                        <div class="row mb-3 form-group">
                            <label for="trade_license"
                                class="col-form-label col-md-4 text-md-right">{{ __('Trade License') }}</label>
                            <div class="col-md-6">
                                <input id="trade_license" type="file"
                                    class="form-control-file @error('trade_license') is-invalid @enderror"
                                    name="trade_license" required>
                                <small class="text-muted form-text">Upload 1 supported file. Max 100 MB.</small>
                                @error('trade_license')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Emirates_ID (File Upload) -->
                        <div class="row mb-3 form-group">
                            <label for="emirates_id"
                                class="col-form-label col-md-4 text-md-right">{{ __('Emirates ID') }}</label>
                            <div class="col-md-6">
                                <input id="emirates_id" type="file"
                                    class="form-control-file @error('emirates_id') is-invalid @enderror"
                                    name="emirates_id" required>
                                <small class="text-muted form-text">Upload 1 supported file. Max 100 MB.</small>
                                @error('emirates_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Passport (File Upload) -->
                        <div class="row mb-3 form-group">
                            <label for="passport"
                                class="col-form-label col-md-4 text-md-right">{{ __('Passport') }}</label>
                            <div class="col-md-6">
                                <input id="passport" type="file"
                                    class="form-control-file @error('passport') is-invalid @enderror" name="passport"
                                    required>
                                <small class="text-muted form-text">Upload 1 supported file. Max 100 MB.</small>
                                @error('passport')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Bank Account No. -->
                        <div class="row mb-3 form-group">
                            <label for="bank_account_no"
                                class="col-form-label col-md-4 text-md-right">{{ __('Bank Account No.') }}</label>
                            <div class="col-md-6">
                                <input id="bank_account_no" type="number"
                                    class="form-control @error('bank_account_no') is-invalid @enderror"
                                    name="bank_account_no" required>
                                @error('bank_account_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Letter for IBAN -->
                        <div class="row mb-3 form-group">
                            <label for="iban_letter"
                                class="col-form-label col-md-4 text-md-right">{{ __('Letter for IBAN') }}</label>
                            <div class="col-md-6">
                                <input id="iban_letter" type="text"
                                    class="form-control @error('iban_letter') is-invalid @enderror" name="iban_letter"
                                    required>
                                @error('iban_letter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- VAT Registration No. (TRN) -->
                        <div class="row mb-3 form-group">
                            <label for="vat_registration_no"
                                class="col-form-label col-md-4 text-md-right">{{ __('VAT Registration No. (TRN)') }}</label>
                            <div class="col-md-6">
                                <input id="vat_registration_no" type="text"
                                    class="form-control @error('vat_registration_no') is-invalid @enderror"
                                    name="vat_registration_no" required>
                                @error('vat_registration_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Person Name -->
                        <div class="row mb-3 form-group">
                            <label for="contact_person_name"
                                class="col-form-label col-md-4 text-md-right">{{ __('Contact Person Name') }}</label>
                            <div class="col-md-6">
                                <input id="contact_person_name" type="text"
                                    class="form-control @error('contact_person_name') is-invalid @enderror"
                                    name="contact_person_name" required>
                                @error('contact_person_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Office Address -->
                        <div class="row mb-3 form-group">
                            <label for="office_address"
                                class="col-form-label col-md-4 text-md-right">{{ __('Office Address') }}</label>
                            <div class="col-md-6">
                                <input id="office_address" type="text"
                                    class="form-control @error('office_address') is-invalid @enderror"
                                    name="office_address" required>
                                @error('office_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mb-0 form-group">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-block"
                                    style="background-color: #007681;color:#fff;">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
