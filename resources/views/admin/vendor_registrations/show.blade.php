@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center page-title-box">
                <h4 class="page-title">Vendor Registration #{{ $registration->id }}</h4>
                <a href="{{ route('vendor-registrations.index') }}" class="btn btn-secondary btn-sm">Back to list</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Details</h5>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Name</div>
                        <div class="col-sm-8">{{ $registration->name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Email</div>
                        <div class="col-sm-8">{{ $registration->email }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Phone Number</div>
                        <div class="col-sm-8">{{ $registration->phone_number }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Contact Person</div>
                        <div class="col-sm-8">{{ $registration->contact_person_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Office Address</div>
                        <div class="col-sm-8">{{ $registration->office_address }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Bank Account No.</div>
                        <div class="col-sm-8">{{ $registration->bank_account_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">IBAN Letter</div>
                        <div class="col-sm-8">{{ $registration->iban_letter }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">VAT Registration No.</div>
                        <div class="col-sm-8">{{ $registration->vat_registration_no }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Submitted</div>
                        <div class="col-sm-8">{{ $registration->created_at->format('Y-m-d H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Documents</h5>
                    <ul class="mb-0 list-unstyled">
                        <li class="mb-2">
                            Trade License:
                            @if ($registration->trade_license)
                                <a target="_blank" href="{{ Storage::url($registration->trade_license) }}">View</a>
                            @else
                                N/A
                            @endif
                        </li>
                        <li class="mb-2">
                            Emirates ID:
                            @if ($registration->emirates_id)
                                <a target="_blank" href="{{ Storage::url($registration->emirates_id) }}">View</a>
                            @else
                                N/A
                            @endif
                        </li>
                        <li class="mb-2">
                            Passport:
                            @if ($registration->passport)
                                <a target="_blank" href="{{ Storage::url($registration->passport) }}">View</a>
                            @else
                                N/A
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
