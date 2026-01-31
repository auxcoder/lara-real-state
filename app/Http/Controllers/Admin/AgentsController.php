<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use DB;
use Illuminate\Http\Request;
use Validator;

class AgentsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Agents::class, 'agent');
    }

    /**
     * Display a listing of the admin.agents.
     */
    public function index()
    {
        $agents = Agents::with('properties')->latest()->paginate(15);
        return view('admin.agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new agent.
     */
    public function create()
    {
        return view('admin.agents.create');
    }

    /**
     * Store a newly created agent in the database.
     */
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email',
            'phone' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'license_number' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $agent = new Agents();
            $agent->name = $request->name;
            $agent->email = $request->email;
            $agent->phone = $request->phone;
            $agent->license_number = $request->license_number;
            $agent->bio = $request->bio;
            $agent->status = $request->status;

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                $imagePath = $request->file('profile_image')->store('profile_images', 'public');
                $agent->profile_image = $imagePath;
            }

            $agent->save();

            DB::commit();
            return redirect()->route('agents.index')->with('success', 'Agent created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while creating the agent: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified agent.
     */
    public function show($id)
    {
        $agent = Agents::findOrFail($id);
        return view('admin.agents.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified agent.
     */
    public function edit($id)
    {
        $agent = Agents::findOrFail($id);
        return view('admin.agents.edit', compact('agent'));
    }

    /**
     * Update the specified agent in the database.
     */
    public function update(Request $request, $id)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:agents,email,$id",
            'phone' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'license_number' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $agent = Agents::findOrFail($id);
            $agent->name = $request->name;
            $agent->email = $request->email;
            $agent->phone = $request->phone;
            $agent->license_number = $request->license_number;
            $agent->bio = $request->bio;
            $agent->status = $request->status;

            // Handle profile image update
            if ($request->hasFile('profile_image')) {
                // Delete the old image if exists
                if ($agent->profile_image && \Storage::exists("public/{$agent->profile_image}")) {
                    \Storage::delete("public/{$agent->profile_image}");
                }

                // Store the new image
                $imagePath = $request->file('profile_image')->store('profile_images', 'public');
                $agent->profile_image = $imagePath;
            }

            $agent->save();

            DB::commit();
            return redirect()->route('agents.index')->with('success', 'Agent updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while updating the agent: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified agent from the database.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $agent = Agents::findOrFail($id);
            if ($agent->profile_image && \Storage::exists("public/{$agent->profile_image}")) {
                \Storage::delete("public/{$agent->profile_image}");
            }
            $agent->delete();

            DB::commit();
            return redirect()->route('agents.index')->with('success', 'Agent deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while deleting the agent: ' . $e->getMessage());
        }
    }
}
