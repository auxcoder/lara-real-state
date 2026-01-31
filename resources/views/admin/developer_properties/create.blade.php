@extends('admin.layout.master')

@section('content')
<div class="container" x-data="developerPropertyForm()">
    <x-admin.page-header 
        title="Add Developer Property" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Developer Properties', 'url' => route('developer_properties.index')],
            ['label' => 'Create']
        ]" 
    />

    <x-admin.card class="mb-4">
        <form action="{{ route('developer_properties.store') }}" method="POST" enctype="multipart/form-data" @submit="validateSlug($event)">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Property Name" @input="updateSlug($event)" required>
                        <label for="name">Property Name</label>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Slug (auto-generated)" @input="markSlugEdited()">
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
                            <option value="{{ $developer->id }}" {{ old('developer_id') == $developer->id ? 'selected' : '' }}>
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
                        <option value="new" {{ old('status') == 'new' ? 'selected' : '' }}>New Launch</option>
                        <option value="under_construction" {{ old('status') == 'under_construction' ? 'selected' : '' }}>Under Construction</option>
                        <option value="ready_to_move" {{ old('status') == 'ready_to_move' ? 'selected' : '' }}>Ready to Move</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" placeholder="Price (AED)">
                        <label for="price">Price (AED)</label>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description">{{ old('description') }}</textarea>
                        <label for="description">Description</label>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" accept="image/*" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="cover_image" class="form-label">Cover Image</label>
                    <input type="file" accept="image/*" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image">
                    @error('cover_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle me-1"></i>Create Property
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

        init() {
            // Slug generation with HTMX is handled in the template
        },

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

// Key Highlights
document.addEventListener('DOMContentLoaded', function() {
    const highlightsTable = document.getElementById('keyHighlightsTable');

    document.querySelector('.add-key-highlight')?.addEventListener('click', function() {
        const tbody = highlightsTable.querySelector('tbody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="text" name="key_highlights[]" class="form-control" placeholder="Highlight"></td>
            <td><button type="button" class="btn btn-danger remove-key-highlight">-</button></td>
        `;
        tbody.appendChild(row);
    });

    highlightsTable.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-key-highlight')) e.target.closest('tr').remove();
    });

    // Payment Plans
    let paymentPlanIndex = {{ isset($developerProperty) && $developerProperty->paymentPlans ? $developerProperty->paymentPlans->count() : 1 }};

    document.getElementById('addPaymentPlan')?.addEventListener('click', function() {
        const container = document.getElementById('paymentPlansContainer');
        const planDiv = document.createElement('div');
        planDiv.className = 'payment-plan mb-4';
        planDiv.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h3>Payment Plan ${paymentPlanIndex + 1}</h3>
                <button type="button" class="btn btn-danger btn-sm remove-payment-plan">Remove Plan</button>
            </div>
            <div class="mb-3">
                <label class="form-label">Plan Heading</label>
                <input type="text" class="form-control" name="paymentPlans[${paymentPlanIndex}][heading]" placeholder="Enter Payment Plan Heading" required>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Installment</th>
                        <th>Payment (%)</th>
                        <th>Milestone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="paymentPlans[${paymentPlanIndex}][installments][0][installment]" class="form-control" placeholder="Installment" required></td>
                        <td><input type="number" name="paymentPlans[${paymentPlanIndex}][installments][0][payment]" class="form-control" placeholder="Payment (%)" required></td>
                        <td><input type="text" name="paymentPlans[${paymentPlanIndex}][installments][0][milestone]" class="form-control" placeholder="Milestone" required></td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-installment">Remove</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-success btn-sm add-installment">Add Installment</button>
        `;
        container.appendChild(planDiv);
        paymentPlanIndex++;
    });

    document.getElementById('paymentPlansContainer')?.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-payment-plan')) {
            e.target.closest('.payment-plan').remove();
            reindexPaymentPlans();
        }

        if (e.target.classList.contains('add-installment')) {
            const planDiv = e.target.closest('.payment-plan');
            const planIdx = Array.from(planDiv.parentElement.children).indexOf(planDiv);
            const tbody = planDiv.querySelector('tbody');
            const instCount = tbody.querySelectorAll('tr').length;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td><input type="text" name="paymentPlans[${planIdx}][installments][${instCount}][installment]" class="form-control" placeholder="Installment" required></td>
                <td><input type="number" name="paymentPlans[${planIdx}][installments][${instCount}][payment]" class="form-control" placeholder="Payment (%)" required></td>
                <td><input type="text" name="paymentPlans[${planIdx}][installments][${instCount}][milestone]" class="form-control" placeholder="Milestone" required></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-installment">Remove</button></td>
            `;
            tbody.appendChild(row);
        }

        if (e.target.classList.contains('remove-installment')) {
            const tbody = e.target.closest('tbody');
            if (tbody.querySelectorAll('tr').length > 1) {
                e.target.closest('tr').remove();
                reindexInstallments(tbody);
            }
        }
    });

    function reindexPaymentPlans() {
        document.querySelectorAll('.payment-plan').forEach((plan, index) => {
            plan.querySelector('h3').textContent = `Payment Plan ${index + 1}`;
            plan.querySelectorAll('input[name^="paymentPlans"]').forEach(input => {
                input.name = input.name.replace(/paymentPlans\[\d+\]/, `paymentPlans[${index}]`);
            });
            reindexInstallments(plan.querySelector('tbody'));
        });
        paymentPlanIndex = document.querySelectorAll('.payment-plan').length;
    }

    function reindexInstallments(tbody) {
        tbody.querySelectorAll('tr').forEach((row, index) => {
            row.querySelectorAll('input[name*="[installments]"]').forEach(input => {
                input.name = input.name.replace(/installments\[\d+\]/, `installments[${index}]`);
            });
        });
    }

    // Amenities
    let amenityIndex = {{ isset($developerProperty) ? $developerProperty->amenities->count() : 1 }};
    document.querySelector('.add-amenity')?.addEventListener('click', function() {
        const tbody = document.querySelector('#amenitiesTable tbody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select class="form-select" name="amenities[${amenityIndex}][amenity_id]">
                    @foreach ($amenities as $amenity)
                        <option value="{{ $amenity->id }}">{{ $amenity->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><button type="button" class="btn btn-danger remove-amenity">-</button></td>
        `;
        tbody.appendChild(row);
        amenityIndex++;
    });

    document.querySelector('#amenitiesTable')?.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-amenity')) {
            e.target.closest('tr').remove();
        }
    });

    // Locations
    let locationIndex = {{ isset($developerProperty) ? $developerProperty->locations->count() : 1 }};
    document.querySelector('.add-location')?.addEventListener('click', function() {
        const tbody = document.querySelector('#locationsTable tbody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select class="form-select" name="locations[${locationIndex}][location_id]">
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="locations[${locationIndex}][distance]" class="form-control" required></td>
            <td><button type="button" class="btn btn-danger remove-location">-</button></td>
        `;
        tbody.appendChild(row);
        locationIndex++;
    });

    document.querySelector('#locationsTable')?.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-location')) {
            e.target.closest('tr').remove();
        }
    });

    // Property Types
    let propertyTypeIndex = {{ isset($developerProperty) ? $developerProperty->propertyTypes->count() : 1 }};
    document.querySelector('.add-property-type')?.addEventListener('click', function() {
        const tbody = document.querySelector('#propertyTypesTable tbody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="text" name="propertyTypes[${propertyTypeIndex}][type]" class="form-control" required></td>
            <td><input type="text" name="propertyTypes[${propertyTypeIndex}][size]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger remove-property-type">-</button></td>
        `;
        tbody.appendChild(row);
        propertyTypeIndex++;
    });

    document.querySelector('#propertyTypesTable')?.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-property-type')) {
            e.target.closest('tr').remove();
        }
    });

    // Floor Plans
    let floorPlanIndex = {{ isset($developerProperty) ? $developerProperty->floorPlans->count() : 1 }};
    document.querySelector('.add-floor-plan')?.addEventListener('click', function() {
        const tbody = document.querySelector('#floorPlansTable tbody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="text" name="floorPlans[${floorPlanIndex}][category]" class="form-control" required></td>
            <td><input type="text" name="floorPlans[${floorPlanIndex}][unit_type]" class="form-control"></td>
            <td><input type="text" name="floorPlans[${floorPlanIndex}][floor_details]" class="form-control"></td>
            <td><input type="text" name="floorPlans[${floorPlanIndex}][sizes]" class="form-control"></td>
            <td><input type="text" name="floorPlans[${floorPlanIndex}][type]" class="form-control"></td>
            <td><input type="file" name="floorPlans[${floorPlanIndex}][image]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger remove-floor-plan">-</button></td>
        `;
        tbody.appendChild(row);
        floorPlanIndex++;
    });

    document.querySelector('#floorPlansTable')?.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-floor-plan')) {
            e.target.closest('tr').remove();
        }
    });
});
</script>
