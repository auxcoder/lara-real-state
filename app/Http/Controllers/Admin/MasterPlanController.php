<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterPlan;
use Illuminate\Http\Request;

class MasterPlanController extends Controller
{
    public function index()
    {
        $masterPlans = MasterPlan::latest()->paginate(15);
        return view('admin.master_plans.index', compact('masterPlans'));
    }

    public function edit(MasterPlan $masterPlan)
    {
        if (request()->header('HX-Request')) {
            return view('admin.master_plans._edit_form', compact('masterPlan'));
        }
        return response()->json(['success' => true, 'masterPlan' => $masterPlan]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $masterPlan = MasterPlan::create([
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        if (request()->header('HX-Request')) {
            return view('admin.master_plans._row', compact('masterPlan'));
        }

        return response()->json(['success' => true, 'masterPlan' => $masterPlan]);
    }

    public function update(Request $request, MasterPlan $masterPlan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255',
        ]);

        $masterPlan->name = $request->name;
        $masterPlan->description = $request->description;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $masterPlan->image = $imagePath;
        }

        $masterPlan->save();

        if (request()->header('HX-Request')) {
            return view('admin.master_plans._row', compact('masterPlan'));
        }

        return response()->json(['success' => true, 'masterPlan' => $masterPlan]);
    }

    public function destroy(MasterPlan $masterPlan)
    {
        $masterPlan->delete();

        if (request()->header('HX-Request')) {
            return response('', 200);
        }

        return response()->json(['success' => true]);
    }
}
