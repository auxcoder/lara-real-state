<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Community;
use Illuminate\Http\Request;
use Storage;

class AmenityController extends Controller
{
    public function index()
    {
        $Amenity = Amenity::all();
        $communities = Community::all();

        return view('admin.amenities.index', compact('Amenity', 'communities'));
    }

    public function create()
    {
        // Return the create view
        return view('admin.amenities.create');
    }

    public function store(Request $request)
    {
        \Log::info($request->all());

        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
        ]);

        // Store the logo and save the path
        $imagePath = $request->file('logo')->store('logos', 'public');

        // Store the Amenity in the database
        Amenity::create([
            'name' => $request->name,
            'logo' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('amenity.index')->with('success', 'Amenity created successfully.');
    }

    public function show(Amenity $amenity)
    {
        // Show a single Amenity
        return view('admin.amenity.show', compact('amenity'));
    }

    public function edit($id)
    {
        $amenity = Amenity::findOrFail($id);

        // Show the edit form
        return view('admin.amenities.edit', compact('amenity'));
    }

    public function update(Request $request, $id)
    {
        \Log::info($request->all());
        // dd($id);
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'community_ids' => 'array',
        ]);
        $amenity = Amenity::findOrFail($id);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
        ];

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($amenity->logo);
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // Update the Amenity in the database
        $amenity->update($data);

        if ($request->has('community_ids')) {
            $amenity->communities()->sync($request->community_ids);
        }

        return redirect()->route('amenity.index')->with('success', 'Amenity updated successfully.');
    }

    public function destroy($id)
    {
        // Delete the Amenity
        $Amenity = Amenity::findOrFail($id);
        Storage::disk('public')->delete($Amenity->logo);
        $Amenity->delete();

        return redirect()->route('amenity.index')->with('success', 'Amenity deleted successfully.');
    }
}
