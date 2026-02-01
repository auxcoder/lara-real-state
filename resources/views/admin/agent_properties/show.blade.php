@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Property Details" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Properties', 'url' => route('property.index')],
            ['label' => 'View']
        ]" 
    />

    <x-admin.card class="mb-4">
        <x-slot name="actions">
            @can('edit agent properties')
                <a href="{{ route('property.edit', $property->id) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-pencil me-1"></i>Edit
                </a>
            @endcan
        </x-slot>

        @php
            $locales = ['en' => 'English', 'es' => 'Spanish', 'ca' => 'Catalan'];
        @endphp

        @foreach ($locales as $locale => $label)
            <div class="mb-4">
                <h5 class="text-primary">{{ $label }}</h5>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table align-middle table-borderless">
                            <tbody>
                                <tr>
                                    <th width="150">Title:</th>
                                    <td>{{ $property->translate($locale)->title ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{!! $property->translate($locale)->description ?? '—' !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach

        <hr>

        <div class="row">
            <div class="col-md-6">
                <table class="table align-middle table-borderless">
                    <tbody>
                        <tr>
                            <th width="150">Location:</th>
                            <td>{{ $property->location }}</td>
                        </tr>
                        <tr>
                            <th>Price:</th>
                            <td>
                                @if (!is_null($property->price))
                                    AED {{ number_format($property->price, 2) }}
                                @else
                                    {{ __('properties.contact_for_price') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Area:</th>
                            <td>{{ $property->area }} sq meter</td>
                        </tr>
                        <tr>
                            <th>Bedrooms:</th>
                            <td>{{ $property->bedrooms ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Bathrooms:</th>
                            <td>{{ $property->bathrooms ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Property Type:</th>
                            <td>{{ $property->property_type }}</td>
                        </tr>
                        <tr>
                            <th>Transaction Type:</th>
                            <td>{{ $property->transaction_type }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <span class="badge bg-{{ $property->status === 'available' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($property->status) }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                @if ($property->main_image)
                    <div class="mb-3">
                        <h6>Main Image:</h6>
                        <img src="{{ asset('storage/' . $property->main_image) }}" alt="Main Image"
                            class="img-fluid rounded shadow" style="max-height: 300px;">
                    </div>
                @endif

                @if ($property->propertygallery && $property->propertygallery->count())
                    <div class="mb-3">
                        <h6>Gallery Images:</h6>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            @foreach ($property->propertygallery as $image)
                                <img src="{{ asset('storage/' . $image->image) }}" alt="Gallery Image"
                                    class="img-thumbnail" style="height: 100px; object-fit: cover;">
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('property.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>Back to List
            </a>
        </div>
    </x-admin.card>
</div>
@endsection
