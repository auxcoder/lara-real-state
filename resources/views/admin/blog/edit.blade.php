@extends('admin.layout.master')

@section('content')
    <x-admin.page-header title="Edit Blog" :breadcrumbs="[['label' => 'Dashboard', 'url' => route('admin.dashboard')], ['label' => 'Blogs', 'url' => route('blogs.index')], ['label' => 'Edit']]" />

    @php
        $locales = ['en' => 'English', 'es' => 'Spanish', 'ca' => 'Catalan'];
    @endphp

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-admin.card title="Blog Information">
            {{-- Current Image --}}
            @if ($blog->image)
                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" width="150" class="mb-2">
                </div>
            @endif

            {{-- Upload New Image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Upload New Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept=".pdf,.docx,.jpg,.jpeg,.png">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Target Audience --}}
            <div class="mb-3">
                <label class="form-label">Target Audience</label>
                <div class="form-check">
                    <input class="form-check-input @error('target_audience') is-invalid @enderror" type="radio" name="target_audience" id="target_uae" value="UAE" {{ old('target_audience', $blog->target_audience) == 'UAE' ? 'checked' : '' }}>
                    <label class="form-check-label" for="target_uae">For UAE</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input @error('target_audience') is-invalid @enderror" type="radio" name="target_audience" id="target_international" value="International" {{ old('target_audience', $blog->target_audience) == 'International' ? 'checked' : '' }}>
                    <label class="form-check-label" for="target_international">For International</label>
                </div>
                @error('target_audience')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </x-admin.card>

        {{-- Loop over languages --}}
        @foreach ($locales as $locale => $language)
            <x-admin.card title="{{ $language }} Content ({{ strtoupper($locale) }})">
                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label">Title ({{ strtoupper($locale) }})</label>
                    <input type="text" name="title[{{ $locale }}]" id="{{ $locale === 'en' ? 'title_en' : '' }}" class="form-control @error("title.$locale") is-invalid @enderror" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}" value="{{ old("title.$locale", $blog->translate($locale)?->title) }}">
                    @error("title.$locale")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Slug input only for English --}}
                @if ($locale === 'en')
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" dir="ltr" value="{{ old('slug', $blog->slug) }}" readonly>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description ({{ strtoupper($locale) }})</label>
                    <textarea name="description[{{ $locale }}]" class="form-control description @error("description.$locale") is-invalid @enderror" rows="5" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">{{ old("description.$locale", $blog->translate($locale)?->description) }}</textarea>
                    @error("description.$locale")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </x-admin.card>
        @endforeach

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success"><i class="bi bi-check-circle me-1"></i>Update Blog</button>
            <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection
