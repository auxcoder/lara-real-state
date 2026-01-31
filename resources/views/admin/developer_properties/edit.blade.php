@extends('admin.layout.master')

@section('content')
<div class="container" x-data="developerPropertyForm()">
    <x-admin.page-header 
        title="Edit Developer Property" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Developer Properties', 'url' => route('developer_properties.index')],
            ['label' => 'Edit']
        ]" 
    />

    <x-admin.card class="mb-4">
        <form action="{{ route('developer_properties.update', $developerProperty->id) }}" method="POST" enctype="multipart/form-data" @submit="validateSlug($event)">
            @csrf
            @method('PUT')
            
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $developerProperty->name) }}" placeholder="Property Name" @input="updateSlug($event)" required>
                        <label for="name">Property Name</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $developerProperty->slug) }}" placeholder="Slug" @input="markSlugEdited()">
                        <label for="slug">Slug</label>
                        <div class="invalid-feedback">Slug must be lowercase letters, numbers, and hyphens only.</div>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="developer_id" class="form-label">Developer</label>
                    <select class="form-select @error('developer_id') is-invalid @enderror" name="developer_id" id="developer_id" required>
                        @foreach ($developers as $developer)
                            <option value="{{ $developer->id }}" {{ old('developer_id', $developerProperty->developer_id) == $developer->id ? 'selected' : '' }}>
                                {{ $developer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('developer_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="new" {{ old('status', $developerProperty->status) == 'new' ? 'selected' : '' }}>New Launch</option>
                        <option value="under_construction" {{ old('status', $developerProperty->status) == 'under_construction' ? 'selected' : '' }}>Under Construction</option>
                        <option value="ready_to_move" {{ old('status', $developerProperty->status) == 'ready_to_move' ? 'selected' : '' }}>Ready to Move</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $developerProperty->price) }}" placeholder="Price (AED)">
                        <label for="price">Price (AED)</label>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description">{{ old('description', $developerProperty->description) }}</textarea>
                        <label for="description">Description</label>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i>Update Property
                </button>
                <a href="{{ route('developer_properties.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </a>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('developerPropertyForm', () => ({
        slugEdited: false,

        slugify(str) {
            return (str || '')
                .toString()
                .normalize('NFKD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        },

        updateSlug(event) {
            if (!this.slugEdited) {
                const slugInput = document.getElementById('slug');
                slugInput.value = this.slugify(event.target.value);
            }
        },

        markSlugEdited() {
            this.slugEdited = true;
        },

        validateSlug(event) {
            const slugInput = document.getElementById('slug');
            const value = (slugInput.value || '').trim();
            const isValid = /^[a-z0-9]+(?:-[a-z0-9]+)*$/.test(value);

            if (value && !isValid) {
                slugInput.classList.add('is-invalid');
                event.preventDefault();
            } else {
                slugInput.classList.remove('is-invalid');
            }
        }
    }));
});
</script>
@endsection