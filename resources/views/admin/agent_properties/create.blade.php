@extends('admin.layout.master')

@section('content')
<div class="container">

    @php
    $locales = ['en' => 'English', 'ar' => 'Arabic'];
    @endphp


    <div class="card mt-5">
        <div class="card-header">
            <h1>Add New Property</h1>
        </div>
        <div class="card-body">

            <form action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs" id="langTabs" role="tablist">
                    @foreach ($locales as $locale => $label)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if ($loop->first) active @endif" id="tab-{{ $locale }}"
                            data-bs-toggle="tab" data-bs-target="#lang-{{ $locale }}" type="button" role="tab"
                            aria-controls="lang-{{ $locale }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $label }}
                        </button>
                    </li>
                    @endforeach
                </ul>

                <!-- Tabs Content -->
                <div class="tab-content border border-top-0 mb-4" id="langTabsContent">
                    @foreach ($locales as $locale => $label)
                    <div class="tab-pane fade @if ($loop->first) show active @endif" id="lang-{{ $locale }}"
                        role="tabpanel">
                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label">Property Title ({{ strtoupper($locale) }})</label>
                            <input type="text" class="form-control" name="title[{{ $locale }}]"
                                dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}" value="{{ old(" title.$locale") }}">
                        </div>
                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label">Description ({{ strtoupper($locale) }})</label>
                            <textarea class="form-control " name="description[{{ $locale }}]" rows="4"
                                dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">{{ old("description.$locale") }}</textarea>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Common Fields -->
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug"
                        placeholder="e.g. marina-view-2br-apartment">
                    <div class="invalid-feedback">Slug must be lowercase letters, numbers, and hyphens only.</div>
                    <small class="text-muted">Auto-generated from English title; you can edit.</small>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <select class="form-control" id="location" name="location">
                        <option value="" hidden>Select a location</option>
                        @foreach (['Dubai', 'Abu Dhabi', 'Sharjah', 'Al Ain', 'Fujairah', 'Ras Al Khaimah'] as $loc)
                        <option value="{{ $loc }}" {{ old('location')==$loc ? 'selected' : '' }}>
                            {{ $loc }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="property_type" class="form-label">Property Type</label>
                    <select class="form-control" name="property_type">
                        <option value="">Select Property Type</option>
                        @foreach (['Residential', 'Commercial', 'Mall', 'Villa'] as $type)
                        <option value="{{ $type }}" {{ old('property_type')==$type ? 'selected' : '' }}>
                            {{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="transaction_type" class="form-label">Transaction Type</label>
                    <select class="form-control" name="transaction_type">
                        <option value="">Select Transaction Type</option>
                        <option value="Rent" {{ old('transaction_type')=='Rent' ? 'selected' : '' }}>Rent</option>
                        {{-- Add more options if needed --}}
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" step="0.01" value="{{ old('price') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Area (sq meter)</label>
                    <input type="number" class="form-control" name="area" step="0.01" value="{{ old('area') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">No. Bedrooms</label>
                    <input type="number" class="form-control" name="bedrooms" value="{{ old('bedrooms') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">No. Bathrooms</label>
                    <input type="number" class="form-control" name="bathrooms" value="{{ old('bathrooms') }}">
                </div>

                <div class="mb-3">
                    <label for="main_image" class="form-label">Main Image</label>
                    <input type="file" class="form-control" name="main_image" accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="gallery_images" class="form-label">Gallery Images</label>
                    <input type="file" class="form-control" name="gallery_images[]" accept="image/*" multiple>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" name="status">
                        <option value="available" {{ old('status')=='available' ? 'selected' : '' }}>Available
                        </option>
                        <option value="sold" {{ old('status')=='sold' ? 'selected' : '' }}>Sold</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Property</button>
            </form>

        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    (function () {
        const enTitle = document.querySelector('input[name="title[en]"]');
        const slugInput = document.getElementById('slug');
        let slugEdited = false;

        function slugify(str) {
            return (str || '')
                .toString()
                .normalize('NFKD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        if (enTitle && slugInput) {
            enTitle.addEventListener('input', () => {
                if (!slugEdited) slugInput.value = slugify(enTitle.value);
            });
            slugInput.addEventListener('input', () => {slugEdited = true;});
        }

        function isValidSlug(val) {
            return /^[a-z0-9]+(?:-[a-z0-9]+)*$/.test(val);
        }

        const form = document.querySelector('form');
        if (form && slugInput) {
            form.addEventListener('submit', (e) => {
                const val = slugInput.value.trim();
                if (val && !isValidSlug(val)) {
                    slugInput.classList.add('is-invalid');
                    e.preventDefault();
                } else {
                    slugInput.classList.remove('is-invalid');
                }
            });
        }
    })();
</script>
@endsection
