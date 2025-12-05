@extends('admin.layout.master')

@section('content')
<div class="container">
    @php
    $locales = ['en' => 'English', 'ar' => 'Arabic'];
    @endphp

    <div class="card mt-5">
        <div class="card-header">
            <h1>Edit Property</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('property.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Language Tabs -->
                <ul class="nav nav-tabs" id="langTabs" role="tablist">
                    @foreach ($locales as $locale => $label)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link @if ($loop->first) active @endif" id="tab-{{ $locale }}"
                            data-bs-toggle="tab" data-bs-target="#lang-{{ $locale }}" type="button" role="tab"
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $label }}
                        </button>
                    </li>
                    @endforeach
                </ul>

                <!-- Language Fields -->
                <div class="tab-content p-3 border border-top-0 mb-4" id="langTabsContent">
                    @foreach ($locales as $locale => $label)
                    <div class="tab-pane fade @if ($loop->first) show active @endif" id="lang-{{ $locale }}"
                        role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label">Title ({{ strtoupper($locale) }})</label>
                            <input type="text" class="form-control" name="title[{{ $locale }}]" value="{{ old("
                                title.$locale", $property->translate($locale)?->title) }}"
                            dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description ({{ strtoupper($locale) }})</label>
                            <textarea class="form-control" name="description[{{ $locale }}]" rows="4"
                                dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">{{ old("description.$locale",
                                $property->translate($locale)?->description) }}</textarea>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Common Fields -->
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug" value="{{ $property->slug }}"
                        placeholder="e.g. marina-view-2br-apartment">
                    <div class="invalid-feedback">Slug must be lowercase letters, numbers, and hyphens only.</div>
                    <small class="text-muted">Auto-generated from English title; you can edit.</small>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <select class="form-control" name="location">
                        @foreach (['Dubai', 'Abu Dhabi', 'Sharjah', 'Al Ain', 'Fujairah', 'Ras Al Khaimah'] as $loc)
                        <option value="{{ $loc }}" {{ $property->location === $loc ? 'selected' : '' }}>
                            {{ $loc }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Property Type</label>
                    <select class="form-control" name="property_type">
                        @foreach (['Residential', 'Commercial', 'Off-Plan', 'Mall', 'Villa'] as $type)
                        <option value="{{ $type }}" {{ $property->property_type === $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Transaction Type</label>
                    <select class="form-control" name="transaction_type">
                        <option value="Rent" {{ $property->transaction_type === 'Rent' ? 'selected' : '' }}>Rent
                        </option>
                        <option value="Sale" {{ $property->transaction_type === 'Sale' ? 'selected' : '' }}>Sale
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" value="{{ $property->price }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Area (sq meter)</label>
                    <input type="number" class="form-control" name="area" value="{{ $property->area }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Bedrooms</label>
                    <input type="number" class="form-control" name="bedrooms" value="{{ $property->bedrooms }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Bathrooms</label>
                    <input type="number" class="form-control" name="bathrooms" value="{{ $property->bathrooms }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Main Image</label><br>
                    @if ($property->main_image)
                    <img src="{{ asset('storage/' . $property->main_image) }}" width="150">
                    @else
                    <p>No image uploaded</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Change Main Image</label>
                    <input type="file" class="form-control" name="main_image" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Gallery Images</label><br>
                    @foreach ($property->propertygallery as $image)
                    <img src="{{ asset('storage/' . $image->image) }}" width="80" class="me-2 mb-2">
                    @endforeach
                    <input type="file" class="form-control mt-2" name="gallery_images[]" multiple>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-control" name="status">
                        <option value="available" {{ $property->status == 'available' ? 'selected' : '' }}>Available
                        </option>
                        <option value="sold" {{ $property->status == 'sold' ? 'selected' : '' }}>Sold</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update Property</button>
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
