@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between page-title-box">
                <h4 class="page-title">Visitor Submission #{{ $submission->id }}</h4>
                <div>
                    <a href="{{ route('visitor-submissions.index') }}" class="btn btn-secondary btn-sm">Back</a>
                    <form action="{{ route('visitor-submissions.destroy', $submission) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Delete this submission?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
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
                        <div class="col-sm-8">{{ $submission->name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Email</div>
                        <div class="col-sm-8">{{ $submission->email }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Phone</div>
                        <div class="col-sm-8">{{ $submission->phone_number }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Nationality</div>
                        <div class="col-sm-8">{{ $submission->nationality }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Payment For Rent</div>
                        <div class="col-sm-8">{{ $submission->payment_for_rent }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">No. Family Members</div>
                        <div class="col-sm-8">{{ $submission->number_of_family_members ?? 'N/A' }}</div>
                    </div>

                    <hr>
                    <h6 class="mb-3">Preferences</h6>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Property Type</div>
                        <div class="col-sm-8">{{ $submission->property_type ?? 'N/A' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Specifications</div>
                        <div class="col-sm-8">{{ $submission->specifications ?? 'N/A' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Preferred Location</div>
                        <div class="col-sm-8">{{ $submission->preferred_location ?? 'N/A' }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4 fw-bold">Budget Range</div>
                        <div class="col-sm-8">{{ $submission->budget_range ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Documents</h5>
                    <ul class="mb-0 list-unstyled">
                        <li class="mb-2">Passport: @if($submission->passport_pdf)<a target="_blank" href="{{ asset('storage/' . $submission->passport_pdf) }}">View</a>@else N/A @endif</li>
                        <li class="mb-2">Emirates ID: @if($submission->emirates_id_pdf)<a target="_blank" href="{{ asset('storage/' . $submission->emirates_id_pdf) }}">View</a>@else N/A @endif</li>
                        <li class="mb-2">Bank Statement: @if($submission->bank_statement_pdf)<a target="_blank" href="{{ asset('storage/' . $submission->bank_statement_pdf) }}">View</a>@else N/A @endif</li>
                        <li class="mb-2">Trade License: @if($submission->trade_license_pdf)<a target="_blank" href="{{ asset('storage/' . $submission->trade_license_pdf) }}">View</a>@else N/A @endif</li>
                        <li class="mb-2">VAT Registration: @if($submission->vat_registration_certificate_pdf)<a target="_blank" href="{{ asset('storage/' . $submission->vat_registration_certificate_pdf) }}">View</a>@else N/A @endif</li>
                        <li class="mb-2">Etihad Credit Bureau: @if($submission->etihad_credit_bureau_pdf)<a target="_blank" href="{{ asset('storage/' . $submission->etihad_credit_bureau_pdf) }}">View</a>@else N/A @endif</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

