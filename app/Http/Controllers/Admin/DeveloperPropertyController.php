<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Community;
use App\Models\Developer;
use App\Models\DeveloperProperty;
use App\Models\FloorPlan;
use App\Models\images;
use App\Models\Location;
use App\Models\MasterPlan;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DeveloperPropertyController extends Controller
{
    public function index()
    {
        $developer_properties = DeveloperProperty::all();
        return view('admin.developer_properties.index', compact('developer_properties'));
    }
    public function create()
    {
        $locations = Location::all();
        $master_plans = MasterPlan::all();
        $Amenity = Amenity::all();
        $developers = Developer::all();
        $communities = Community::all();
        return view('admin.developer_properties.create', compact('locations', 'communities', 'developers', 'master_plans', 'Amenity'));
    }

    public function edit($id)
    {
        $developerProperty = DeveloperProperty::with(['images', 'locations', 'propertyTypes', 'floorPlans', 'masterPlans', 'Amenity'])->findOrFail($id);
        $developers = Developer::all();
        $communities = Community::all();
        $master_plans = MasterPlan::all();
        $locations = Location::all();
        $Amenity = Amenity::all();

        return view('admin.developer_properties.create', compact('developerProperty', 'developers', 'communities', 'master_plans', 'locations', 'Amenity'));
    }

    private function validateRequest(Request $request, $isUpdate = false)
    {
        $id = $request->route('developer_property') ?? $request->route('developer_properties') ?? null;
        $slugRule = Rule::unique('developer_properties', 'slug');
        if ($isUpdate && $id) {
            $slugRule = $slugRule->ignore($id);
        }
        return $request->validate([
            'developer_id' => 'required|exists:developers,id',
            'name' => 'required|string|max:255',
            'slug' => ['nullable','alpha_dash', $slugRule],
            'status' => 'required|string|in:new,under_construction,ready_to_move',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'payment_plans' => 'required|array',
            'payment_plans.*.heading' => 'required|string',
            'payment_plans.*.installments' => 'required|array',
            'payment_plans.*.installments.*.installment' => 'required|string',
            'payment_plans.*.installments.*.payment' => 'required|numeric',
            'payment_plans.*.installments.*.milestone' => 'required|string',
            'handover_date' => 'nullable|date',
            'handover_percentage' => 'nullable|numeric',
            'down_percentage' => 'nullable|numeric',
            'construction_percentage' => 'nullable|numeric',
            'community' => 'required|exists:communities,id',

            // Make 'logo' and 'cover_image' required only on create (i.e., not in update)
            'logo' => $isUpdate ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_image' => $isUpdate ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

            'gallery_images.*' => 'nullable|image|max:2048',
            'master_plan_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location_map' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'locations.*.location_id' => 'required|exists:locations,id',
            'locations.*.distance' => 'required|numeric',
            'property_types.*.property_type' => 'required|string|max:255',
            'property_types.*.unit_type' => 'nullable|string|max:255',
            'property_types.*.size' => 'nullable|string|max:255',
            'floor_plans.*.category' => 'required|string|max:255',
            'floor_plans.*.unit_type' => 'nullable|string|max:255',
            'floor_plans.*.floor_details' => 'nullable|string|max:255',
            'floor_plans.*.sizes' => 'nullable|string|max:255',
            'floor_plans.*.type' => 'nullable|string|max:255',
            'floor_plans.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenity_ids.*' => 'exists:amenities,id',
            'master_plan_id.*' => 'exists:master_plans,id',
        ]);
    }



    public function store(Request $request)
    {
        // Validate the request
        $this->validateRequest($request);

        // Start the database transaction
        DB::beginTransaction();

        try {
            // Store the main developer property
            $developerProperty = DeveloperProperty::create([
                'developer_id' => $request->developer_id,
                'name' => $request->name,
                'slug' => $request->slug,
                'status' => $request->status,
                'price' => $request->filled('price') ? $request->price : null,
                'description' => $request->description,
                'payment_plan' => $request->payment_plans,
                'handover_date' => $request->handover_date,
                'handover_percentage' => $request->handover_percentage,
                'down_percentage' => $request->down_percentage,
                'construction_percentage' => $request->construction_percentage,
                'community' => $request->community,
                'logo' => $this->uploadFile($request, 'logo'),
                'cover_image' => $this->uploadFile($request, 'cover_image'),
                'master_plan_image' => $this->uploadFile($request, 'master_plan_image'),
                'location_map' => $this->uploadFile($request, 'location_map'),
                'master_plan_description' => $request->master_plan_descripion,
                'floor_plan_description' => $request->floor_plan_description,
                'location_map_description' => $request->location_map_description,
            ]);

            // Store key highlights
            if ($request->key_highlights) {
                $developerProperty->key_highlights = implode(',', $request->key_highlights);
                $developerProperty->save();
            }

            // Store gallery images
            if ($request->gallery_images) {
                $imagePaths = $this->uploadFile($request, 'gallery_images');
                if (is_array($imagePaths)) {
                    foreach ($imagePaths as $imagePath) {
                        images::create([
                            'developer_property_id' => $developerProperty->id,
                            'image' => $imagePath,
                        ]);
                    }
                } else {
                    images::create([
                        'developer_property_id' => $developerProperty->id,
                        'image' => $imagePaths,
                    ]);
                }
            }


            // Store property types
            if ($request->property_types) {
                foreach ($request->property_types as $propertyType) {
                    PropertyType::create([
                        'developer_property_id' => $developerProperty->id,
                        'property_type' => $propertyType['property_type'],
                        'unit_type' => $propertyType['unit_type'],
                        'size' => $propertyType['size'],
                    ]);
                }
            }

            // Store floor plans
            if ($request->floor_plans) {
                foreach ($request->floor_plans as $floorPlan) {
                    $floorPlanImage = $this->uploadFile($request, 'floor_plans.' . key($floorPlan) . '.image');
                    FloorPlan::create([
                        'developer_property_id' => $developerProperty->id,
                        'category' => $floorPlan['category'],
                        'unit_type' => $floorPlan['unit_type'],
                        'floor_details' => $floorPlan['floor_details'],
                        'sizes' => $floorPlan['sizes'],
                        'type' => $floorPlan['type'],
                        'image' => $floorPlanImage, // This can be a single image or null
                    ]);
                }
            }

            // Store locations with distance
            if ($request->locations) {
                foreach ($request->locations as $location) {
                    $developerProperty->locations()->attach($location['location_id'], ['distance' => $location['distance']]);
                }
            }

            // Store Amenity
            if ($request->amenity_ids) {
                $developerProperty->Amenity()->sync($request->amenity_ids);
            }

            if ($request->master_plan_id) {
                $developerProperty->masterPlans()->sync($request->master_plan_id);
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('developer_properties.index')->with('success', 'Property created successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction on failure
            DB::rollBack();
            throw $e;
            return redirect()->back()->withErrors(['error' => 'Failed to create property: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $this->validateRequest($request, true);
        // dd($request->all());
        // Start the database transaction
        DB::beginTransaction();

        try {
            $developerProperty = DeveloperProperty::findOrFail($id);

            // Update the developer property
            $developerProperty->update([
                'developer_id' => $request->developer_id,
                'name' => $request->name,
                'slug' => $request->slug ?: $developerProperty->slug,
                'status' => $request->status,
                'price' => $request->filled('price') ? $request->price : null,
                'description' => $request->description,
                'payment_plan' => $request->payment_plans,
                'handover_date' => $request->handover_date,
                'handover_percentage' => $request->handover_percentage,
                'down_percentage' => $request->down_percentage,
                'construction_percentage' => $request->construction_percentage,
                'community' => $request->community,
                // Update images only if they are present
                'logo' => $this->updateFile($request, 'logo', $developerProperty->logo),
                'cover_image' => $this->updateFile($request, 'cover_image', $developerProperty->cover_image),
                'master_plan_image' => $this->updateFile($request, 'master_plan_image', $developerProperty->master_plan_image),
                'location_map' => $this->updateFile($request, 'location_map', $developerProperty->location_map),
                'master_plan_description' => $request->master_plan_description,
                'floor_plan_description' => $request->floor_plan_description,
                'location_map_description' => $request->location_map_description,
            ]);

            // Update key highlights
            if ($request->key_highlights) {
                $developerProperty->key_highlights = implode(',', $request->key_highlights);
                $developerProperty->save();
            }

            // Handle gallery images
            if ($request->gallery_images) {
                foreach ($request->gallery_images as $key => $image) {
                    $imagePath = $this->uploadFile($request, 'gallery_images.' . $key);
                    images::create([
                        'developer_property_id' => $developerProperty->id,
                        'image' => $imagePath,
                    ]);
                }
                // Optionally, delete the old images if they were not included in the new upload
            }

            // Update property types
            if ($request->property_types) {
                // Clear existing types and save new ones
                $developerProperty->propertyTypes()->delete();
                foreach ($request->property_types as $propertyType) {
                    PropertyType::create([
                        'developer_property_id' => $developerProperty->id,
                        'property_type' => $propertyType['property_type'],
                        'unit_type' => $propertyType['unit_type'],
                        'size' => $propertyType['size'],
                    ]);
                }
            }

            // Update floor plans
            if ($request->floor_plans) {
                // Clear existing floor plans and save new ones
                $developerProperty->floorPlans()->delete();
                foreach ($request->floor_plans as $floorPlan) {
                    FloorPlan::create([
                        'developer_property_id' => $developerProperty->id,
                        'category' => $floorPlan['category'],
                        'unit_type' => $floorPlan['unit_type'],
                        'floor_details' => $floorPlan['floor_details'],
                        'sizes' => $floorPlan['sizes'],
                        'type' => $floorPlan['type'],
                        'image' => $this->uploadFile($request, 'floor_plans.' . key($floorPlan) . '.image')
                    ]);
                }
            }

            // Update locations
            if ($request->locations) {
                // Clear existing locations and save new ones
                $developerProperty->locations()->detach();
                foreach ($request->locations as $location) {
                    $developerProperty->locations()->attach($location['location_id'], ['distance' => $location['distance']]);
                }
            }

            // Update Amenity
            if ($request->amenity_ids) {
                $developerProperty->Amenity()->sync($request->amenity_ids);
            }

            if ($request->master_plan_id) {
                $developerProperty->masterPlans()->sync($request->master_plan_id);
            }

            // Commit the transaction
            DB::commit();

            return redirect()->route('developer_properties.index')->with('success', 'Property updated successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction on failure
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to update property: ' . $e->getMessage()]);
        }
    }

    private function uploadFile(Request $request, $fieldName)
    {
        // Check if the field is present in the request
        if ($request->hasFile($fieldName)) {
            $files = $request->file($fieldName);

            // If it's a single file, wrap it in an array for consistent processing
            if (!is_array($files)) {
                $files = [$files];
            }

            $filePaths = []; // Initialize an array to hold the file paths

            // Loop through each file and store it
            foreach ($files as $file) {
                $filePaths[] = $file->store('developer_properties', 'public');
            }

            return count($filePaths) === 1 ? $filePaths[0] : $filePaths; // Return single path or array
        }

        return null; // Return null if no files are uploaded
    }

    private function updateFile(Request $request, $fieldName, $oldFilePath)
    {
        if ($request->hasFile($fieldName)) {
            // Delete old file if it exists
            if ($oldFilePath) {
                Storage::disk('public')->delete($oldFilePath);
            }

            return $this->uploadFile($request, $fieldName);
        }
        return $oldFilePath; // Return old file path if no new file is uploaded
    }

    public function destroy($id)
    {
        // Delete the Amenity
        $Amenity = DeveloperProperty::findOrFail($id);
        $Amenity->delete();

        return redirect()->route('developer_properties.index')->with('success', 'Property deleted successfully.');
    }
}
