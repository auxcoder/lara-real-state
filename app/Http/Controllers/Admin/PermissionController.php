<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::latest()->paginate(15);
        return view('admin.permission.index', compact('permissions'));
    }
    public function create()
    {
        $data['permissions'] = Permission::get();
        return view('admin.permission.create', $data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();

        Permission::create($input);

        return redirect()->route('permission.index')
        ->with('success', 'Permission updated successfully');
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();


        $user = Permission::find($id);
        $user->update($input);

        return redirect()->route('permission.index')
            ->with('success', 'Permission updated successfully');
    }
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        if (request()->header('HX-Request')) {
            return response('', 200);
        }

        return redirect()->route('permission.index')->with('success', 'Permission deleted successfully.');
    }

}
