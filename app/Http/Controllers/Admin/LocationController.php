<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $Locations = Location::latest()->paginate(15);
        return view('admin.location.index', compact('Locations'));
    }

    public function edit(Location $location)
    {
        if (request()->header('HX-Request')) {
            return view('admin.location._edit_form', compact('location'));
        }
        return response()->json(['success' => true, 'location' => $location]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:225',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $location = Location::create([
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        if (request()->header('HX-Request')) {
            return view('admin.location._row', compact('location'));
        }

        return response()->json(['success' => true, 'location' => $location]);
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:225',
        ]);

        $location->name = $request->name;
        $location->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $location->image = $imagePath;
        }

        $location->save();

        if (request()->header('HX-Request')) {
            return view('admin.location._row', compact('location'));
        }

        return response()->json(['success' => true, 'location' => $location]);
    }

    public function destroy(Location $location)
    {
        $location->delete();

        if (request()->header('HX-Request')) {
            return response('', 200);
        }

        return response()->json(['success' => true]);
    }
}
