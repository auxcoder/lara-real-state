@php
$locales = ['en' => 'English', 'es' => 'Spanish', 'ca' => 'Catalan'];
@endphp

<!-- Language Tabs -->
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

<!-- Language Fields -->
<div class="my-3 tab-content" id="langTabsContent">
    @foreach ($locales as $locale => $label)
    <div class="fade tab-pane @if ($loop->first) show active @endif" id="lang-{{ $locale }}" role="tabpanel">
        <div class="mb-3">
            <label class="form-label">Property Title ({{ strtoupper($locale) }})</label>
            <input type="text" class="form-control @error("title.$locale") is-invalid @enderror" name="title[{{ $locale }}]"
                @if($locale === 'en')
                    hx-post="{{ route('slugify') }}"
                    hx-trigger="keyup changed delay:500ms"
                    hx-target="#slug"
                    hx-swap="outerHTML"
                    hx-include="[name='title[en]']"
                @endif
                dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}"
                value="{{ old("title.$locale", isset($property) ? $property->translate($locale)?->title : '') }}">
            @error("title.$locale")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Description ({{ strtoupper($locale) }})</label>
            <textarea class="form-control @error("description.$locale") is-invalid @enderror" name="description[{{ $locale }}]" rows="4"
                dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">{{ old("description.$locale", isset($property) ? $property->translate($locale)?->description : '') }}</textarea>
            @error("description.$locale")
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    @endforeach
</div>

<!-- Common Fields -->
<div class="mb-3">
    <label class="form-label">Slug</label>
    <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug"
        value="{{ old('slug', isset($property) ? $property->slug : '') }}"
        placeholder="e.g. marina-view-2br-apartment">
    @error('slug')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <small class="text-muted">Auto-generated from English title; you can edit.</small>
</div>

<div class="mb-3">
    <label for="location" class="form-label">Location</label>
    <select class="form-control @error('location') is-invalid @enderror" id="location" name="location">
        <option value="" hidden>Select a location</option>
        @foreach (config('locations.provinces', ['Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Málaga', 'Zaragoza']) as $loc)
        <option value="{{ $loc }}" {{ old('location', isset($property) ? $property->location : '') == $loc ? 'selected' : '' }}>
            {{ $loc }}
        </option>
        @endforeach
    </select>
    @error('location')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="property_type" class="form-label">Property Type</label>
    <select class="form-control @error('property_type') is-invalid @enderror" name="property_type">
        <option value="">Select Property Type</option>
        @foreach (['Residential', 'Commercial', 'Off-Plan', 'Mall', 'Villa'] as $type)
        <option value="{{ $type }}" {{ old('property_type', isset($property) ? $property->property_type : '') == $type ? 'selected' : '' }}>
            {{ $type }}
        </option>
        @endforeach
    </select>
    @error('property_type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="transaction_type" class="form-label">Transaction Type</label>
    <select class="form-control @error('transaction_type') is-invalid @enderror" name="transaction_type">
        <option value="">Select Transaction Type</option>
        <option value="Rent" {{ old('transaction_type', isset($property) ? $property->transaction_type : '') == 'Rent' ? 'selected' : '' }}>Rent</option>
        <option value="Sale" {{ old('transaction_type', isset($property) ? $property->transaction_type : '') == 'Sale' ? 'selected' : '' }}>Sale</option>
    </select>
    @error('transaction_type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Price</label>
    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" step="0.01"
        value="{{ old('price', isset($property) ? $property->price : '') }}">
    @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Area (sq meter)</label>
    <input type="number" class="form-control @error('area') is-invalid @enderror" name="area" step="0.01"
        value="{{ old('area', isset($property) ? $property->area : '') }}">
    @error('area')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">No. Bedrooms</label>
    <input type="number" class="form-control @error('bedrooms') is-invalid @enderror" name="bedrooms"
        value="{{ old('bedrooms', isset($property) ? $property->bedrooms : '') }}">
    @error('bedrooms')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">No. Bathrooms</label>
    <input type="number" class="form-control @error('bathrooms') is-invalid @enderror" name="bathrooms"
        value="{{ old('bathrooms', isset($property) ? $property->bathrooms : '') }}">
    @error('bathrooms')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if(isset($property) && $property->main_image)
<div class="mb-3">
    <label class="form-label">Current Main Image</label>
    <div class="mb-2">
        <img src="{{ asset('storage/' . $property->main_image) }}" width="150" class="rounded">
    </div>
</div>
@endif

<div class="mb-3">
    <label for="main_image" class="form-label">{{ isset($property) ? 'Change Main Image' : 'Main Image' }}</label>
    <input type="file" class="form-control @error('main_image') is-invalid @enderror" name="main_image" accept="image/*">
    @if(isset($property))
        <small class="text-muted">Leave empty to keep current image</small>
    @endif
    @error('main_image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if(isset($property) && $property->propertygallery && $property->propertygallery->count())
<div class="mb-3">
    <label class="form-label">Current Gallery Images</label>
    <div class="d-flex flex-wrap gap-2">
        @foreach ($property->propertygallery as $image)
            <img src="{{ asset('storage/' . $image->image) }}" width="80" class="rounded">
        @endforeach
    </div>
</div>
@endif

<div class="mb-3">
    <label for="gallery_images" class="form-label">{{ isset($property) ? 'Add Gallery Images' : 'Gallery Images' }}</label>
    <input type="file" class="form-control @error('gallery_images') is-invalid @enderror" name="gallery_images[]" accept="image/*" multiple>
    @error('gallery_images')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select class="form-control @error('status') is-invalid @enderror" name="status">
        <option value="available" {{ old('status', isset($property) ? $property->status : 'available') == 'available' ? 'selected' : '' }}>Available</option>
        <option value="sold" {{ old('status', isset($property) ? $property->status : '') == 'sold' ? 'selected' : '' }}>Sold</option>
    </select>
    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
