@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Vendor Registration Details" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Vendor Registrations', 'url' => route('vendor-registrations.index')],
            ['label' => 'View']
        ]" 
    />

    <div class="row">
        <div class="col-lg-8">
            <x-admin.card title="Registration Details">
                <table class="table align-middle table-borderless">
                    <tbody>
                        <tr>
                            <th width="200">Name:</th>
                            <td>{{ $registration->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $registration->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone Number:</th>
                            <td>{{ $registration->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Contact Person:</th>
                            <td>{{ $registration->contact_person_name }}</td>
                        </tr>
                        <tr>
                            <th>Office Address:</th>
                            <td>{{ $registration->office_address }}</td>
                        </tr>
                        <tr>
                            <th>Bank Account No.:</th>
                            <td>{{ $registration->bank_account_no }}</td>
                        </tr>
                        <tr>
                            <th>IBAN Letter:</th>
                            <td>{{ $registration->iban_letter }}</td>
                        </tr>
                        <tr>
                            <th>VAT Registration No.:</th>
                            <td>{{ $registration->vat_registration_no }}</td>
                        </tr>
                        <tr>
                            <th>Submitted:</th>
                            <td>{{ $registration->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-3">
                    <a href="{{ route('vendor-registrations.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Back to List
                    </a>
                </div>
            </x-admin.card>
        </div>

        <div class="col-lg-4">
            <x-admin.card title="Documents">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <strong>Trade License:</strong>
                        @if ($registration->trade_license)
                            <a target="_blank" href="{{ Storage::url($registration->trade_license) }}" class="btn btn-link btn-sm p-0">
                                <i class="bi bi-file-earmark-pdf me-1"></i>View
                            </a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </li>
                    <li class="mb-2">
                        <strong>Emirates ID:</strong>
                        @if ($registration->emirates_id)
                            <a target="_blank" href="{{ Storage::url($registration->emirates_id) }}" class="btn btn-link btn-sm p-0">
                                <i class="bi bi-file-earmark-pdf me-1"></i>View
                            </a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </li>
                    <li class="mb-2">
                        <strong>Passport:</strong>
                        @if ($registration->passport)
                            <a target="_blank" href="{{ Storage::url($registration->passport) }}" class="btn btn-link btn-sm p-0">
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
