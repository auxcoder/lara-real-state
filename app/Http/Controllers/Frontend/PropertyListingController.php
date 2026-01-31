<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AgentProperty;
use App\Models\Community;
use App\Models\Developer;
use App\Models\DeveloperProperty;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function secondarySale()
    {
        $properties = AgentProperty::with(['agent:id,name', 'translations'])
            ->select('id', 'agent_id', 'name', 'price', 'bedrooms', 'bathrooms', 'area', 'image', 'slug')
            ->paginate(5);

        return view('frontend.secondary_properties_sale', compact('properties'));
    }

    public function details($slug)
    {
        $property = AgentProperty::with(['agent', 'propertygallery', 'translations'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.property_details', compact('property'));
    }

    public function offplan()
    {
        $communities = Community::select('id', 'name')->get();
        $developers = Developer::select('id', 'name')->get();
        $properties = DeveloperProperty::with(['developer:id,name', 'propertyTypes:id,name', 'locations:id,name'])
            ->paginate(5);

        return view('frontend.offplan', compact('properties', 'communities', 'developers'));
    }

    public function byLocation($location)
    {
        $properties = AgentProperty::with(['agent:id,name', 'translations'])
            ->whereHas('translations', function ($q) use ($location) {
                $q->where('location', 'like', "%{$location}%");
            })
            ->paginate(10);

        return view('frontend.properties_by_location', compact('properties', 'location'));
    }
}
