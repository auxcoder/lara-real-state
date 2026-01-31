<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Community;
use Illuminate\Http\Request;
use Storage;

class CommunityController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Community::class, 'community');
    }

    public function index()
    {
        $communities = Community::all();
        $amenities = Amenity::all();
        // dd($amenities) ;
        return view('admin.communities.index', compact('communities', 'amenities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'feature_description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenities' => 'required|array',
            'amenities.*' => 'exists:amenities,id',
            'location' => 'required',
        ]);

        // Store the image and save the path
        $imagePath = $request->file('image')->store('images', 'public');

        $community = Community::create([
            'name' => $request->name,
            'description' => $request->description,
            'feature_description' => $request->feature_description,
            'image' => $imagePath,
            'location' => $request->location,
        ]);

        // Attach the selected amenities to the community
        $community->amenities()->attach($request['amenities']);


        return redirect()->route('communities.index')->with('success', 'Community created successfully.');
    }

    public function update(Request $request, Community $community)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'feature_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'amenity_id' => 'array',
            'location' => 'required',

        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'feature_description' => $request->feature_description,
            'location' => $request->location,
        ];

        // Check if an image was uploaded
        if ($request->hasFile('image')) {
            // Delete the old image
            Storage::disk('public')->delete($community->image);
            // Store the new image and save the path
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $community->update($data);

        if ($request->filled('amenities')) {
            $community->amenities()->sync($request->input('amenities', []));
        }
        return redirect()->route('communities.index')->with('success', 'Community updated successfully.');
    }

    public function destroy(Community $community)
    {
        Storage::disk('public')->delete($community->image);
        $community->amenities()->detach();
        $community->delete();
        return redirect()->route('communities.index')->with('success', 'Community deleted successfully.');
    }

}
