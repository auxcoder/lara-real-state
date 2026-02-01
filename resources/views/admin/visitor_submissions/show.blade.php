@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Visitor Submission Details" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Visitor Submissions', 'url' => route('visitor-submissions.index')],
            ['label' => 'View']
        ]" 
    />

    <div class="row">
        <div class="col-lg-8">
            <x-admin.card title="Personal Details">
                <table class="table align-middle table-borderless">
                    <tbody>
                        <tr>
                            <th width="200">Name:</th>
                            <td>{{ $submission->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $submission->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $submission->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Nationality:</th>
                            <td>{{ $submission->nationality }}</td>
                        </tr>
                        <tr>
                            <th>Payment For Rent:</th>
                            <td>{{ $submission->payment_for_rent }}</td>
                        </tr>
                        <tr>
                            <th>No. Family Members:</th>
                            <td>{{ $submission->number_of_family_members ?? 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>
            </x-admin.card>

            <x-admin.card title="Property Preferences" class="mt-3">
                <table class="table align-middle table-borderless">
                    <tbody>
                        <tr>
                            <th width="200">Property Type:</th>
                            <td>{{ $submission->property_type ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Specifications:</th>
                            <td>{{ $submission->specifications ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Preferred Location:</th>
                            <td>{{ $submission->preferred_location ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Budget Range:</th>
                            <td>{{ $submission->budget_range ?? 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-3">
                    <a href="{{ route('visitor-submissions.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Back to List
                    </a>
                </div>
            </x-admin.card>
        </div>

        <div class="col-lg-4">
            <x-admin.card title="Documents">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <strong>Passport:</strong>
                        @if($submission->passport_pdf)
                            <a target="_blank" href="{{ asset('storage/' . $submission->passport_pdf) }}" class="btn btn-link btn-sm p-0">
                                <i class="bi bi-file-earmark-pdf me-1"></i>View
                            </a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </li>
                    <li class="mb-2">
                        <strong>Emirates ID:</strong>
                        @if($submission->emirates_id_pdf)
                            <a target="_blank" href="{{ asset('storage/' . $submission->emirates_id_pdf) }}" class="btn btn-link btn-sm p-0">
                                <i class="bi bi-file-earmark-pdf me-1"></i>View
                            </a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </li>
                    <li class="mb-2">
                        <strong>Bank Statement:</strong>
                        @if($submission->bank_statement_pdf)
                            <a target="_blank" href="{{ asset('storage/' . $submission->bank_statement_pdf) }}" class="btn btn-link btn-sm p-0">
                                <i class="bi bi-file-earmark-pdf me-1"></i>View
                            </a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </li>
                    <li class="mb-2">
                        <strong>Trade License:</strong>
                        @if($submission->trade_license_pdf)
                            <a target="_blank" href="{{ asset('storage/' . $submission->trade_license_pdf) }}" class="btn btn-link btn-sm p-0">
                                <i class="bi bi-file-earmark-pdf me-1"></i>View
                            </a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </li>
                    <li class="mb-2">
                        <strong>VAT Registration:</strong>
                        @if($submission->vat_registration_certificate_pdf)
                            <a target="_blank" href="{{ asset('storage/' . $submission->vat_registration_certificate_pdf) }}" class="btn btn-link btn-sm p-0">
                                <i class="bi bi-file-earmark-pdf me-1"></i>View
                            </a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </li>
                    <li class="mb-2">
                        <strong>Etihad Credit Bureau:</strong>
                        @if($submission->etihad_credit_bureau_pdf)
                            <a target="_blank" href="{{ asset('storage/' . $submission->etihad_credit_bureau_pdf) }}" class="btn btn-link btn-sm p-0">
                                <i class="bi bi-file-earmark-pdf me-1"></i>View
                            </a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </li>
                </ul>
            </x-admin.card>
        </div>
    </div>
</div>
@endsection

