<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DeveloperController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Developer::class, 'developer');
    }

    public function index()
    {
        $developers = Developer::latest()->paginate(15);
        return view('admin.developers.index', compact('developers'));
    }

    public function create()
    {
        return view('admin.developers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:developers,email',
            'phone' => 'required|string|max:20',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        DB::beginTransaction();
        try {
            $developer = new Developer();
            $developer->name = $request->name;
            $developer->email = $request->email;
            $developer->phone = $request->phone;
            $developer->description = $request->description;
            $developer->status = $request->status;

            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('logos', 'public');
                $developer->logo = $logoPath;
            }

            $developer->save();
            DB::commit();

            return redirect()->route('developers.index')->with('success', __('success.created', ['item' => __('Developers')]));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Error creating developer: ' . $e->getMessage());
        }
    }

    public function show(Developer $developer)
    {
        return view('admin.developers.show', compact('developer'));
    }

    public function edit(Developer $developer)
    {
        return view('admin.developers.create', compact('developer'));
    }

    public function update(Request $request, Developer $developer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:developers,email,{$developer->id}",
            'phone' => 'required|string|max:20',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        DB::beginTransaction();
        try {
            $developer->name = $request->name;
            $developer->email = $request->email;
            $developer->phone = $request->phone;
            $developer->description = $request->description;
            $developer->status = $request->status;

            if ($request->hasFile('logo')) {
                if ($developer->logo) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $developer->logo));
                }
                $logoPath = $request->file('logo')->store('logos', 'public');
                $developer->logo = "/storage/$logoPath";
            }

            $developer->save();
            DB::commit();

            return redirect()->route('developers.index')->with('success', __('success.updated', ['item' => __('Developers')]));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Error updating developer: ' . $e->getMessage());
        }
    }

    public function destroy(Developer $developer)
    {
        DB::beginTransaction();
        try {
            if ($developer->logo) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $developer->logo));
            }

            $developer->delete();
            DB::commit();

            return redirect()->route('developers.index')->with('success', __('success.deleted', ['item' => __('Developers')]));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Error deleting developer: ' . $e->getMessage());
        }
    }
}
