<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AgentProperty;
use App\Models\Community;
use App\Models\Developer;
use App\Models\DeveloperProperty;
use App\Models\Location;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    protected $property_types = ['Residential', 'Commercial', 'Off-Plan', 'Mall', 'Villa'];
    protected $cities = ['Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman'];

    public function __construct(
        private CacheService $cache
    ) {}

    public function index()
    {
        $developer_properties = DeveloperProperty::latest()->take(3)->get();
        $property_types = array_diff($this->property_types, ['Commercial', 'Mall']);
        $cities = $this->cities;
        $communities = $this->cache->getLocations()->toArray();

        return view('frontend.index', compact('developer_properties', 'property_types', 'cities', 'communities'));
    }

    public function filter(Request $request)
    {
        $validated = $request->validate([
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0|gte:min_price',
            'status' => 'nullable|string',
            'sort' => 'nullable|string',
            'field3' => 'nullable|string',
        ]);

        $query = DeveloperProperty::query();

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('field3')) {
            $query->where('name', 'LIKE', '%'.$request->input('field3').'%');
        }

        if ($request->has('sort')) {
            switch ($request->input('sort')) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'price_high_to_low':
                    $query->orderBy('price', 'desc');
                    break;
                case 'price_low_to_high':
                    $query->orderBy('price', 'asc');
                    break;
            }
        }

        $properties = $query->paginate(20)->appends($request->except('page'));
        $communities = $this->cache->getCommunities();
        $developers = $this->cache->getDevelopers();
        $search = $request->input('field3');

        return view('frontend.offplan', compact('properties', 'search', 'communities', 'developers'));
    }

    public function showByLocation(Request $request, $location)
    {
        // Implementation from showPropertiesByLocation
        return view('frontend.properties-by-location');
    }

    public function offplan(Request $request)
    {
        $communities = $this->cache->getCommunities();
        $developer_property = DeveloperProperty::all();
        $developers = $this->cache->getDevelopers();


        $properties = DeveloperProperty::paginate(5);

        return view('frontend.offplan', compact('properties', 'communities', 'developer_property', 'developers'));
    }

    public function secondarySale()
    {
        $properties = AgentProperty::paginate(5);

        return view('frontend.secondary_properties_sale', compact('properties'));
    }

    public function show($slug)
    {
        $property = AgentProperty::with('propertygallery')->where('slug', $slug)->firstOrFail();

        return view('frontend.devPropertyDetails', compact('property'));
    }

    public function propertyDetails($slug)
    {
        $property = AgentProperty::where('slug', $slug)->firstOrFail();

        return view('frontend.property_details', compact('property'));
    }

    public function addressResidence($slug)
    {
        $developer_property = DeveloperProperty::where('slug', $slug)->firstOrFail();

        return view('frontend.address_residence', compact('developer_property'));
    }

    public function paymentPlan($slug)
    {
        $developer_property = DeveloperProperty::where('slug', $slug)->firstOrFail();

        return view('frontend.payment_plan', compact('developer_property'));
    }

    public function locationMap($slug)
    {
        $developer_property = DeveloperProperty::where('slug', $slug)->firstOrFail();

        return view('frontend.location_map', compact('developer_property'));
    }

    public function masterPlan($slug)
    {
        $developer_property = DeveloperProperty::where('slug', $slug)->firstOrFail();

        return view('frontend.master_plan', compact('developer_property'));
    }

    public function floorPlan($slug)
    {
        $developer_property = DeveloperProperty::where('slug', $slug)->firstOrFail();

        return view('frontend.floor_plan', compact('developer_property'));
    }
}
