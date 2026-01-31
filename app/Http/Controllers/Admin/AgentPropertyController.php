<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAgentPropertyRequest;
use App\Http\Requests\UpdateAgentPropertyRequest;
use App\Models\AgentProperty;
use App\Models\Agents;
use App\Services\AgentPropertyService;
use App\Models\PropertyGalleryImages;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Validator;

class AgentPropertyController extends Controller
{
    public function __construct(
        private AgentPropertyService $propertyService
    ) {
        $this->authorizeResource(AgentProperty::class, 'property');
    }

    /**
     * Display a listing of the property.
     */
    public function index()
    {
        $properties = AgentProperty::with(['agent', 'translations'])
            ->latest()
            ->paginate(15);
        return view('admin.agent_properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        $agents = Agents::active()->get();
        return view('admin.agent_properties.create', compact('agents'));
    }

    /**
     * Store a newly created property in the database.
     */
    public function store(StoreAgentPropertyRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $request->filled('slug') ? $request->slug : null;
        $data['price'] = $request->filled('price') ? $request->price : null;

        $property = $this->propertyService->create(
            $data,
            $request->file('main_image'),
            $request->file('gallery_images', [])
        );

        return redirect()->route('property.show', $property->id)->with('success', __('success.created', ['item' => __('Properties')]));
    }


    /**
     * Display the specified property.
     */
    public function show($id)
    {
        $property = AgentProperty::findOrFail($id);
        return view('admin.agent_properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified property.
     */
    public function edit($id)
    {
        $property = AgentProperty::findOrFail($id);
        $agents = Agents::get();
        return view('admin.agent_properties.edit', compact('property', 'agents'));
    }

    /**
     * Update the specified property in the database.
     */
    public function update(UpdateAgentPropertyRequest $request, $id)
    {
        $property = AgentProperty::findOrFail($id);
        
        $data = $request->validated();
        $data['slug'] = $request->filled('slug') ? $request->slug : $property->slug;
        $data['price'] = $request->filled('price') ? $request->price : null;

        $this->propertyService->update(
            $property,
            $data,
            $request->file('main_image'),
            $request->file('gallery_images', [])
        );

        return redirect()->route('property.edit', $property->id)->with('success', __('success.updated', ['item' => __('Properties')]));
    }



    /**
     * Remove the specified property from the database.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $property = AgentProperty::findOrFail($id);

            if ($property->image && \Storage::exists('public/' . $property->image)) {
                \Storage::delete("public/{$property->image}");
            }

            $property->delete();
            DB::commit();

            return redirect()->route('property.index')->with('success', 'Property deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Backfill missing slugs for Agent Properties using the English title (or first available title).
     */
    // public function backfillSlugs()
    // {
    //     // Run artisan migrate and capture the output
    //     $exitCode = Artisan::call('migrate');
    //     $output = Artisan::output();

    //     $updated = 0;

    //     // Find properties without slugs
    //     $properties = AgentProperty::whereNull('slug')->orWhere('slug', '')->get();

    //     foreach ($properties as $property) {
    //         $title = optional($property->translations()->where('locale', 'en')->first())->title
    //             ?? optional($property->translations()->first())->title
    //             ?? ('property-' . $property->id);

    //         $base = Str::slug($title) ?: ('property-' . $property->id);
    //         $slug = $base;
    //         $i = 2;

    //         // Ensure uniqueness
    //         while (AgentProperty::where('slug', $slug)->where('id', '!=', $property->id)->exists()) {
    //             $slug = $base . '-' . $i;
    //             $i++;
    //         }

    //         $property->slug = $slug;
    //         $property->save();
    //         $updated++;
    //     }



    //     // Return JSON response with both results
    //     return response()->json([
    //         'updated' => $updated,
    //         'migrate_exit_code' => $exitCode,
    //         'migrate_output' => $output,
    //     ]);
    // }

    public function slugify(Request $request)
    {
        $title = $request->input('title.en', '');
        $slug = Str::slug($title);
        
        return response('<input type="text" class="form-control" name="slug" id="slug" value="' . e($slug) . '" placeholder="e.g. marina-view-2br-apartment"><small class="text-muted">Auto-generated from English title; you can edit.</small>');
    }
}
