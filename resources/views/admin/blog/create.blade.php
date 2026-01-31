@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Create New Blog" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Blogs', 'url' => route('blogs.index')],
            ['label' => 'Create']
        ]" 
    />

    @php
        $locales = ['en' => 'English', 'ar' => 'Arabic'];
    @endphp

    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-admin.card title="Blog Information">
            <div class="mb-3">
                <label for="image" class="form-label">Upload Blog Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept=".jpg,.jpeg,.png">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Target Audience</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="target_audience" id="target_uae"
                                value="UAE" {{ old('target_audience', 'UAE') == 'UAE' ? 'checked' : '' }}>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Target Audience</label>
                <div class="form-check">
                    <input class="form-check-input @error('target_audience') is-invalid @enderror" type="radio" name="target_audience" id="target_uae" value="UAE" {{ old('target_audience') == 'UAE' ? 'checked' : '' }}>
                    <label class="form-check-label" for="target_uae">For UAE</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="target_audience" id="target_international" value="International" {{ old('target_audience') == 'International' ? 'checked' : '' }}>
                    <label class="form-check-label" for="target_international">For International</label>
                </div>
                @error('target_audience')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </x-admin.card>

        @foreach ($locales as $locale => $language)
            <x-admin.card :title="$language . ' Content (' . strtoupper($locale) . ')'" class="mb-3">
                <div class="mb-3">
                    <label class="form-label">Title ({{ strtoupper($locale) }})</label>
                    <input type="text" name="title[{{ $locale }}]" id="{{ $locale === 'en' ? 'title_en' : '' }}" class="form-control @error('title.'.$locale) is-invalid @enderror" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}" value="{{ old("title.$locale") }}">
                    @error('title.'.$locale)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if ($locale === 'en')
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" readonly>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Description ({{ strtoupper($locale) }})</label>
                    <textarea name="description[{{ $locale }}]" class="form-control @error('description.'.$locale) is-invalid @enderror" rows="5" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">{{ old("description.$locale") }}</textarea>
                    @error('description.'.$locale)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </x-admin.card>
        @endforeach

        <div class="d-flex gap-2 mb-4">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle me-1"></i>Create Blog
            </button>
            <a href="{{ route('blogs.index') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle me-1"></i>Cancel
            </a>
        </div>
    </form>
</div>
@endsection
