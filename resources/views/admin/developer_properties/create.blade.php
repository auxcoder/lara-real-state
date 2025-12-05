@extends('admin.layout.master')

@section('content')
    <div class="container">
        <h1 class="mb-4">{{ isset($developerProperty) ? 'Edit Developer Property' : 'Add Developer Property' }}</h1>
        <form
            action="{{ isset($developerProperty) ? route('developer_properties.update', $developerProperty->id) : route('developer_properties.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($developerProperty))
                @method('PUT')
            @endif
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ isset($developerProperty) ? $developerProperty->name : '' }}"
                            placeholder="Property Name" required>
                        <label for="name">Property Name</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="slug" name="slug"
                            value="{{ isset($developerProperty) ? $developerProperty->slug : '' }}"
                            placeholder="Slug (auto-generated)">
                        <label for="slug">Slug</label>
                        <div class="invalid-feedback">Slug must be lowercase letters, numbers, and hyphens only.</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="developer_id" class="form-label">Developer</label>
                    <select class="form-select select2" name="developer_id" id="developer_id" required>
                        @foreach ($developers as $developer)
                            <option value="{{ $developer->id }}"
                                {{ isset($developerProperty) && $developerProperty->developer_id == $developer->id ? 'selected' : '' }}>
                                {{ $developer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="new"
                            {{ isset($developerProperty) && $developerProperty->status == 'new' ? 'selected' : '' }}>New
                            Launch</option>
                        <option value="under_construction"
                            {{ isset($developerProperty) && $developerProperty->status == 'under_construction' ? 'selected' : '' }}>
                            Under Construction</option>
                        <option value="ready_to_move"
                            {{ isset($developerProperty) && $developerProperty->status == 'ready_to_move' ? 'selected' : '' }}>
                            Ready to Move</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="price" name="price"
                            value="{{ isset($developerProperty) ? $developerProperty->price : '' }}"
                            placeholder="Price (AED)">
                        <label for="price">Price (AED)</label>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" id="description" name="description" placeholder="Description">{{ isset($developerProperty) ? $developerProperty->description : '' }}</textarea>
                        <label for="description">Description</label>
                    </div>
                </div>

                <div class="col-12">
                    <label for="key_highlights" class="form-label">Key Highlights</label>
                    <table class="table" id="keyHighlightsTable">
                        <tbody>
                            @if (isset($developerProperty) && $developerProperty->key_highlights)
                                @foreach (explode(',', $developerProperty->key_highlights) as $highlight)
                                    <tr>
                                        <td><input type="text" name="key_highlights[]" class="form-control"
                                                value="{{ $highlight }}" placeholder="Highlight"></td>
                                        <td><button type="button" class="btn btn-danger remove-key-highlight">-</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td><input type="text" name="key_highlights[]" class="form-control"
                                            placeholder="Highlight"></td>
                                    <td><button type="button" class="btn btn-danger remove-key-highlight">-</button></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success add-key-highlight">+</button>
                </div>


                <div class="col-12">
                    <label class="form-label">Payment Plans</label>
                    <div id="paymentPlansContainer">
                        {{-- @dd($developerProperty->paymentPlan) --}}
                        @if (isset($developerProperty) && $developerProperty->paymentPlan)
                            @foreach ($developerProperty->paymentPlan as $planIndex => $paymentPlan)
                                <div class="payment-plan mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h3>Payment Plan {{ $planIndex + 1 }}</h3>
                                        <button type="button" class="btn btn-danger btn-sm remove-payment-plan">Remove
                                            Plan</button>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Plan Heading</label>
                                        <input type="text" class="form-control"
                                            name="paymentPlans[{{ $planIndex }}][heading]"
                                            value="{{ $paymentPlan['heading'] }}" placeholder="Enter Payment Plan Heading"
                                            required>
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
                                            @foreach ($paymentPlan['installments'] as $instIndex => $installment)
                                                <tr>
                                                    <td>
                                                        <input type="text"
                                                            name="paymentPlans[{{ $planIndex }}][installments][{{ $instIndex }}][installment]"
                                                            class="form-control" value="{{ $installment['installment'] }}"
                                                            placeholder="Installment" required>
                                                    </td>
                                                    <td>
                                                        <input type="number"
                                                            name="paymentPlans[{{ $planIndex }}][installments][{{ $instIndex }}][payment]"
                                                            class="form-control" value="{{ $installment['payment'] }}"
                                                            placeholder="Payment (%)" required>
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                            name="paymentPlans[{{ $planIndex }}][installments][{{ $instIndex }}][milestone]"
                                                            class="form-control" value="{{ $installment['milestone'] }}"
                                                            placeholder="Milestone" required>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm remove-installment">Remove</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-success btn-sm add-installment">Add
                                        Installment</button>
                                </div>
                            @endforeach
                        @else
                            <div class="payment-plan mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h3>Payment Plan 1</h3>
                                    <button type="button" class="btn btn-danger btn-sm remove-payment-plan">Remove
                                        Plan</button>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Plan Heading</label>
                                    <input type="text" class="form-control" name="paymentPlans[0][heading]"
                                        placeholder="Enter Payment Plan Heading" required>
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
                                            <td>
                                                <input type="text"
                                                    name="paymentPlans[0][installments][0][installment]"
                                                    class="form-control" placeholder="Installment" required>
                                            </td>
                                            <td>
                                                <input type="number" name="paymentPlans[0][installments][0][payment]"
                                                    class="form-control" placeholder="Payment (%)" required>
                                            </td>
                                            <td>
                                                <input type="text" name="paymentPlans[0][installments][0][milestone]"
                                                    class="form-control" placeholder="Milestone" required>
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-danger btn-sm remove-installment">Remove</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-success btn-sm add-installment">Add
                                    Installment</button>
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary mt-2" id="addPaymentPlan">Add Payment Plan</button>
                </div>


                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="handover_date" name="handover_date"
                            value="{{ isset($developerProperty) ? $developerProperty->handover_date : '' }}"
                            placeholder="Handover Date">
                        <label for="handover_date">Handover Date</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="handover_percentage" name="handover_percentage"
                            value="{{ isset($developerProperty) ? $developerProperty->handover_percentage : '' }}"
                            placeholder="Handover Percentage">
                        <label for="handover_percentage">Handover Percentage</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="down_percentage" name="down_percentage"
                            value="{{ isset($developerProperty) ? $developerProperty->down_percentage : '' }}"
                            placeholder="Down Payment Percentage">
                        <label for="down_percentage">Down Payment Percentage</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="construction_percentage"
                            name="construction_percentage"
                            value="{{ isset($developerProperty) ? $developerProperty->construction_percentage : '' }}"
                            placeholder="Construction Percentage">
                        <label for="construction_percentage">Construction Percentage</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="logo" class="form-label">Logo</label>
                    <input type="file" accept="image/*" class="form-control" id="logo" name="logo">
                    @if (isset($developerProperty) && $developerProperty->logo)
                        <img src="{{ asset('storage/' . $developerProperty->logo) }}" alt="Logo"
                            class="img-thumbnail mt-2" style="max-width: 150px;">
                    @endif
                </div>

                <div class="col-md-6">
                    <label for="cover_image" class="form-label">Cover Image</label>
                    <input type="file" accept="image/*" class="form-control" id="cover_image" name="cover_image">
                    @if (isset($developerProperty) && $developerProperty->cover_image)
                        <img src="{{ asset('storage/' . $developerProperty->cover_image) }}" alt="Cover Image"
                            class="img-thumbnail mt-2" style="max-width: 150px;">
                    @endif
                </div>

                <div class="col-md-6">
                    <label for="community" class="form-label">Community</label>
                    <select class="form-select" name="community" id="community">
                        @foreach ($communities as $community)
                            <option value="{{ $community->id }}"
                                {{ isset($developerProperty) && $developerProperty->community == $community->id ? 'selected' : '' }}>
                                {{ $community->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="gallery_images" class="form-label">Gallery Images</label>
                    <input type="file" accept="image/*" class="form-control" id="gallery_images"
                        name="gallery_images[]" multiple>
                    @if (isset($developerProperty) && $developerProperty->images)
                        <div class="mt-2">
                            @foreach ($developerProperty->images as $image)
                                <img src="{{ asset('storage/' . $image->image) }}" alt="Gallery Image"
                                    class="img-thumbnail" style="max-width: 150px; margin-right: 10px;">
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <label for="masterPlan_image" class="form-label">Master Plan Image</label>
                    <input type="file" accept="image/*" class="form-control" id="masterPlan_image"
                        name="masterPlan_image">
                    @if (isset($developerProperty) && $developerProperty->masterPlan_image)
                        <img src="{{ asset('storage/' . $developerProperty->masterPlan_image) }}"
                            alt="Master Plan Image" class="img-thumbnail mt-2" style="max-width: 150px;">
                    @endif
                </div>

                <div class="col-md-6">
                    <label for="locationMap" class="form-label">Location Map</label>
                    <input type="file" accept="image/*" class="form-control" id="locationMap" name="locationMap">
                    @if (isset($developerProperty) && $developerProperty->locationMap)
                        <img src="{{ asset('storage/' . $developerProperty->locationMap) }}" alt="Location Map"
                            class="img-thumbnail mt-2" style="max-width: 150px;">
                    @endif
                </div>

                <div class="col-md-6">
                    <label for="masterPlan_description">Master Plan Description</label>
                    <textarea name="masterPlan_description" id="masterPlan_description" cols="30" rows="10"
                        class="form-control" required>{{ isset($developerProperty) ? $developerProperty->masterPlan_description : '' }}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="locationMap_description">Location Map Description</label>
                    <textarea name="locationMap_description" id="locationMap_description" cols="30" rows="10"
                        class="form-control" required>{{ isset($developerProperty) ? $developerProperty->locationMap_description : '' }}</textarea>
                </div>



                <div class="col-12">
                    <label for="locations" class="form-label">Locations</label>
                    <table class="table" id="locationsTable">
                        <thead>
                            <tr>
                                <th>Location</th>
                                <th>Distance (minutes)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($developerProperty) && $developerProperty->locations)
                                @foreach ($developerProperty->locations as $index => $location)
                                    <tr>
                                        <td>
                                            <select class="form-select select2"
                                                name="locations[{{ $index }}][location_id]">
                                                @foreach ($locations as $loc)
                                                    <option value="{{ $loc->id }}"
                                                        {{ $loc->id == $location->id ? 'selected' : '' }}>
                                                        {{ $loc->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="locations[{{ $index }}][distance]"
                                                class="form-control" value="{{ $location->pivot->distance }}" required>
                                        </td>
                                        <td><button type="button" class="btn btn-danger remove-location">-</button></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <select class="form-select select2" name="locations[0][location_id]">
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="number" name="locations[0][distance]" class="form-control"
                                            required></td>
                                    <td><button type="button" class="btn btn-danger remove-location">-</button></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success add-location">+</button>
                </div>


                <div class="col-12">
                    <label for="property_types" class="form-label">Property Types</label>
                    <table class="table" id="propertyTypesTable">
                        <thead>
                            <tr>
                                <th>Property Type</th>
                                <th>Unit Type</th>
                                <th>Size</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $propertyTypes = [
                                    ['label' => 'Residential'],
                                    ['label' => 'Commercial'],
                                    ['label' => 'Off-Plan'],
                                    ['label' => 'Mall'],
                                    ['label' => 'Villa'],
                                ];
                            @endphp
                            @if (isset($developerProperty) && $developerProperty->propertyTypes)
                                @foreach ($developerProperty->propertyTypes as $index => $propertyType)
                                    <tr>
                                        <td>

                                            <select name="property_types[{{ $index }}][property_type]"
                                                class="form-select form-control" required>
                                                <option value="" disabled selected
                                                    {{ old('property_types.' . $index . '.property_type', $propertyType->property_type) ? '' : 'selected' }}>
                                                    Property Type
                                                </option>
                                                @foreach ($propertyTypes as $type)
                                                    <option value="{{ $type['label'] }}"
                                                        {{ old('property_types.' . $index . '.property_type', $propertyType->property_type) == $type['label'] ? 'selected' : '' }}>
                                                        {{ $type['label'] }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </td>
                                        <td><input type="text" name="property_types[{{ $index }}][unit_type]"
                                                class="form-control" value="{{ $propertyType->unit_type }}"></td>
                                        <td><input type="text" name="property_types[{{ $index }}][size]"
                                                class="form-control" value="{{ $propertyType->size }}"></td>
                                        <td><button type="button" class="btn btn-danger remove-property-type">-</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <select name="property_types[0][property_type]" class="form-select form-control"
                                            required>
                                            <option value="" disabled>Property Type
                                            </option>
                                            @foreach ($propertyTypes as $type)
                                                <option value="{{ $type['label'] }}">
                                                    {{ $type['label'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="property_types[0][property_type]"
                                            class="form-control" required> --}}
                                    </td>
                                    <td><input type="text" name="property_types[0][unit_type]" class="form-control">
                                    </td>
                                    <td><input type="text" name="property_types[0][size]" class="form-control"></td>
                                    <td><button type="button" class="btn btn-danger remove-property-type">-</button></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success add-property-type">+</button>
                </div>


                <div class="col-12">
                    <label for="floorPlans" class="form-label">Floor Plans</label>
                    <table class="table" id="floorPlansTable">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Unit Type</th>
                                <th>Floor Details</th>
                                <th>Sizes</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($developerProperty) && $developerProperty->floorPlans)
                                @foreach ($developerProperty->floorPlans as $index => $floorPlan)
                                    <tr>
                                        <td><input type="text" name="floorPlans[{{ $index }}][category]"
                                                class="form-control" value="{{ $floorPlan->category }}" required></td>
                                        <td><input type="text" name="floorPlans[{{ $index }}][unit_type]"
                                                class="form-control" value="{{ $floorPlan->unit_type }}"></td>
                                        <td><input type="text" name="floorPlans[{{ $index }}][floor_details]"
                                                class="form-control" value="{{ $floorPlan->floor_details }}"></td>
                                        <td><input type="text" name="floorPlans[{{ $index }}][sizes]"
                                                class="form-control" value="{{ $floorPlan->sizes }}"></td>
                                        <td><input type="text" name="floorPlans[{{ $index }}][type]"
                                                class="form-control" value="{{ $floorPlan->type }}"></td>
                                        <td><input type="file" name="floorPlans[{{ $index }}][image]"
                                                class="form-control"></td>
                                        <td><button type="button" class="btn btn-danger remove-floor-plan">-</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td><input type="text" name="floorPlans[0][category]" class="form-control"
                                            required></td>
                                    <td><input type="text" name="floorPlans[0][unit_type]" class="form-control"></td>
                                    <td><input type="text" name="floorPlans[0][floor_details]" class="form-control">
                                    </td>
                                    <td><input type="text" name="floorPlans[0][sizes]" class="form-control"></td>
                                    <td><input type="text" name="floorPlans[0][type]" class="form-control"></td>
                                    <td><input type="file" name="floorPlans[0][image]" class="form-control"></td>
                                    <td><button type="button" class="btn btn-danger remove-floor-plan">-</button></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-success add-floor-plan">+</button>
                </div>

                <div class="col-12">
                    <label for="floorPlan_description">Floor Plan Description</label>
                    <textarea name="floorPlan_description" id="floorPlan_description" cols="30" rows="10"
                        class="form-control" required>{{ isset($developerProperty) ? $developerProperty->floorPlan_description : '' }}</textarea>

                </div>


                <div class="col-md-6">
                    <label for="masterPlan" class="form-label">Master Plan</label>
                    <select class="form-select select2" id="masterPlan" name="masterPlan_id[]" multiple>
                        @foreach ($masterPlans as $masterPlan)
                            <option value="{{ $masterPlan->id }}"
                                {{ isset($developerProperty) && $developerProperty->masterPlans->contains($masterPlan->id) ? 'selected' : '' }}>
                                {{ $masterPlan->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="Amenity" class="form-label">Amenity</label>
                    <select class="form-select select2" id="Amenity" name="amenity_ids[]" multiple>
                        @foreach ($Amenity as $amenity)
                            <option value="{{ $amenity->id }}"
                                {{ isset($developerProperty) && $developerProperty->Amenity->contains($amenity->id) ? 'selected' : '' }}>
                                {{ $amenity->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit"
                class="btn btn-primary mt-4">{{ isset($developerProperty) ? 'Update' : 'Submit' }}</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Slug generation/validation
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
            const $name = $('#name');
            const $slug = $('#slug');
            let slugEdited = false;
            $name.on('input', function(){ if(!slugEdited){ $slug.val(slugify($(this).val())); } });
            $slug.on('input', function(){ slugEdited = true; });
            function isValidSlug(v){ return /^[a-z0-9]+(?:-[a-z0-9]+)*$/.test(v); }
            $('form').on('submit', function(e){
                const v = ($slug.val() || '').trim();
                if(v && !isValidSlug(v)){
                    $slug.addClass('is-invalid');
                    e.preventDefault();
                } else {
                    $slug.removeClass('is-invalid');
                }
            });

            // Initialize payment plan index based on existing plans
            var paymentPlanIndex =
                {{ isset($developerProperty) && $developerProperty->paymentPlans ? $developerProperty->paymentPlans->count() : 1 }};

            // Add Payment Plan
            $('#addPaymentPlan').click(function() {
                var newPaymentPlan = `
        <div class="payment-plan mb-4">
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
                        <td>
                            <input type="text" name="paymentPlans[${paymentPlanIndex}][installments][0][installment]" class="form-control" placeholder="Installment" required>
                        </td>
                        <td>
                            <input type="number" name="paymentPlans[${paymentPlanIndex}][installments][0][payment]" class="form-control" placeholder="Payment (%)" required>
                        </td>
                        <td>
                            <input type="text" name="paymentPlans[${paymentPlanIndex}][installments][0][milestone]" class="form-control" placeholder="Milestone" required>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-installment">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-success btn-sm add-installment">Add Installment</button>
        </div>
    `;
                $('#paymentPlansContainer').append(newPaymentPlan);
                paymentPlanIndex++;
            });

            // Remove Payment Plan
            $(document).on('click', '.remove-payment-plan', function() {
                $(this).closest('.payment-plan').remove();
                // Re-index payment plans
                $('#paymentPlansContainer .payment-plan').each(function(index) {
                    $(this).find('h3').text('Payment Plan ' + (index + 1));
                    // Update input names
                    $(this).find('input[name^="paymentPlans"]').each(function() {
                        var name = $(this).attr('name');
                        var newName = name.replace(/paymentPlans\[\d+\]/,
                            `paymentPlans[${index}]`);
                        $(this).attr('name', newName);
                    });
                    // Update installment names
                    $(this).find('input[name*="[installments]"]').each(function(instIndex) {
                        var name = $(this).attr('name');
                        var newName = name.replace(/installments\[\d+\]/,
                            `installments[${instIndex}]`);
                        $(this).attr('name', newName);
                    });
                });
                paymentPlanIndex = $('#paymentPlansContainer .payment-plan').length;
            });

            // Add Installment within a Payment Plan
            $(document).on('click', '.add-installment', function() {
                var paymentPlanDiv = $(this).closest('.payment-plan');
                var planIdx = paymentPlanDiv.index();
                var installmentCount = paymentPlanDiv.find('tbody tr').length;
                var newInstallment = `
        <tr>
            <td>
                <input type="text" name="paymentPlans[${planIdx}][installments][${installmentCount}][installment]" class="form-control" placeholder="Installment" required>
            </td>
            <td>
                <input type="number" name="paymentPlans[${planIdx}][installments][${installmentCount}][payment]" class="form-control" placeholder="Payment (%)" required>
            </td>
            <td>
                <input type="text" name="paymentPlans[${planIdx}][installments][${installmentCount}][milestone]" class="form-control" placeholder="Milestone" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-installment">Remove</button>
            </td>
        </tr>
    `;
                paymentPlanDiv.find('tbody').append(newInstallment);
            });

            // Remove Installment
            $(document).on('click', '.remove-installment', function() {
                $(this).closest('tr').remove();
            });
            // Location Add Row
            var locationIndex = {{ isset($developerProperty) ? $developerProperty->locations->count() : 1 }};
            $('.add-location').click(function() {
                $('#locationsTable tbody').append(`
                    <tr>
                        <td>
                            <select class="form-select select2" name="locations[${locationIndex}][location_id]">
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="locations[${locationIndex}][distance]" class="form-control" required></td>
                        <td><button type="button" class="btn btn-danger remove-location">-</button></td>
                    </tr>
                `);
                locationIndex++;
                $('.select2').select2(); // Reinitialize select2 for new rows
            });

            $(document).on('click', '.remove-location', function() {
                $(this).closest('tr').remove();
            });

            // Property Type Add Row
            var propertyTypeIndex =
                {{ isset($developerProperty) ? $developerProperty->propertyTypes->count() : 1 }};
            $('.add-property-type').click(function() {
                $('#propertyTypesTable tbody').append(`
                    <tr>
                        <td>
                            <select name="property_types[${propertyTypeIndex}][property_type]" class="form-select form-control" required>
                                <option value="" disabled selected>Property Type</option>
                                <option value="Residential">Residential</option>
                                <option value="Commercial">Commercial</option>
                                <option value="Off-Plan"">Off-Plan</option>
                                <option value="Mall">Mall</option>
                                <option value="Villa">Villa</option>
                         </select>
                     </td>
                        <td><input type="text" name="property_types[${propertyTypeIndex}][unit_type]" class="form-control"></td>
                        <td><input type="text" name="property_types[${propertyTypeIndex}][size]" class="form-control"></td>
                        <td><button type="button" class="btn btn-danger remove-property-type">-</button></td>
                    </tr>
                `);
                propertyTypeIndex++;
            });

            $(document).on('click', '.remove-property-type', function() {
                $(this).closest('tr').remove();
            });

            // Key Highlight Add Row
            $('.add-key-highlight').click(function() {
                $('#keyHighlightsTable tbody').append(`
                    <tr>
                        <td><input type="text" name="key_highlights[]" class="form-control"></td>
                        <td><button type="button" class="btn btn-danger remove-key-highlight">-</button></td>
                    </tr>
                `);
            });

            $(document).on('click', '.remove-key-highlight', function() {
                $(this).closest('tr').remove();
            });

            // Floor Plan Add Row
            var floorPlanIndex = {{ isset($developerProperty) ? $developerProperty->floorPlans->count() : 1 }};
            $('.add-floor-plan').click(function() {
                $('#floorPlansTable tbody').append(`
                    <tr>
                        <td><input type="text" name="floorPlans[${floorPlanIndex}][category]" class="form-control" required></td>
                        <td><input type="text" name="floorPlans[${floorPlanIndex}][unit_type]" class="form-control"></td>
                        <td><input type="text" name="floorPlans[${floorPlanIndex}][floor_details]" class="form-control"></td>
                        <td><input type="text" name="floorPlans[${floorPlanIndex}][sizes]" class="form-control"></td>
                        <td><input type="text" name="floorPlans[${floorPlanIndex}][type]" class="form-control"></td>
                        <td><input type="file" name="floorPlans[${floorPlanIndex}][image]" class="form-control"></td>
                        <td><button type="button" class="btn btn-danger remove-floor-plan">-</button></td>
                    </tr>
                `);
                floorPlanIndex++;
            });

            $(document).on('click', '.remove-floor-plan', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
