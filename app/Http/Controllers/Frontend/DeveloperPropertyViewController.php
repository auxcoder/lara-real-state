<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DeveloperProperty;

class DeveloperPropertyController extends Controller
{
    public function addressResidence($slug)
    {
        $developer_property = DeveloperProperty::with(['developer', 'propertyTypes', 'locations', 'Amenity', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.address_residence', compact('developer_property'));
    }

    public function paymentPlan($slug)
    {
        $developer_property = DeveloperProperty::with(['developer:id,name'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.payment_plan', compact('developer_property'));
    }

    public function locationMap($slug)
    {
        $developer_property = DeveloperProperty::with(['locations'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.location_map', compact('developer_property'));
    }

    public function masterPlan($slug)
    {
        $developer_property = DeveloperProperty::with(['masterPlans'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.master_plan', compact('developer_property'));
    }

    public function floorPlan($slug)
    {
        $developer_property = DeveloperProperty::with(['floorPlans'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.floor_plan', compact('developer_property'));
    }
}
