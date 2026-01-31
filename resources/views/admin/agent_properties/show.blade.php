@extends('admin.layout.master')

@section('content')
<div class="container">
    <h1>Property Details</h1>

    <hr>

    @php
        $locales = ['en' => 'English', 'ar' => 'Arabic'];
    @endphp

    @foreach ($locales as $locale => $label)
        <div class="mb-4">
            <h3>{{ $label }}</h3>

            <div class="mb-2">
                <strong>Title ({{ strtoupper($locale) }}):</strong>
                <p>{{ $property->translate($locale)->title ?? '—' }}</p>
            </div>

            <div class="mb-2">
                <strong>Description ({{ strtoupper($locale) }}):</strong>
                <p>{!! $property->translate($locale)->description ?? '—' !!}</p>
            </div>
        </div>
    @endforeach

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-2"><strong>Location:</strong> {{ $property->location }}</div>
            <div class="mb-2">
                <strong>Price:</strong>
                @if (!is_null($property->price))
                    AED {{ number_format($property->price, 2) }}
                @else
                    {{ __('properties.contact_for_price') }}
                @endif
            </div>
            <div class="mb-2"><strong>Area:</strong> {{ $property->area }} sq meter</div>
            <div class="mb-2"><strong>Bedrooms:</strong> {{ $property->bedrooms ?? 'N/A' }}</div>
            <div class="mb-2"><strong>Bathrooms:</strong> {{ $property->bathrooms ?? 'N/A' }}</div>
            <div class="mb-2"><strong>Property Type:</strong> {{ $property->property_type }}</div>
            <div class="mb-2"><strong>Transaction Type:</strong> {{ $property->transaction_type }}</div>
            <div class="mb-2"><strong>Status:</strong> {{ ucfirst($property->status) }}</div>
        </div>

        <div class="col-md-6">
            @if ($property->main_image)
                <div class="mb-3">
                    <strong>Main Image:</strong><br>
                    <img src="{{ asset('storage/' . $property->main_image) }}" alt="Main Image"
                        class="img-fluid rounded shadow" style="max-height: 300px;">
                </div>
            @endif

            @if ($property->propertygallery && $property->propertygallery->count())
                <div class="mb-3">
                    <strong>Gallery Images:</strong>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        @if (isset($property->propertygallery))
                            @foreach ($property->propertygallery as $image)
                                <img src="{{ asset('storage/' . $image->image) }}" alt="Gallery Image"
                                    class="img-thumbnail" style="height: 100px; object-fit: cover;">
                            @endforeach
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    <hr>

    <a href="{{ route('property.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
