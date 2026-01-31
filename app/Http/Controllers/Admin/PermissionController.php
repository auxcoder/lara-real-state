<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    public function index()
    {
        $this->authorize('manage permissions');
        
        $permissions = Permission::latest()->paginate(15);
        return view('admin.permission.index', compact('permissions'));
    }
    public function create()
    {
        $this->authorize('manage permissions');
        
        $data['permissions'] = Permission::get();
        return view('admin.permission.create', $data);
    }
    public function store(Request $request)
    {
        $this->authorize('manage permissions');
        
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();

        Permission::create($input);

        return redirect()->route('permission.index')
        ->with('success', __('success.updated', ['item' => __('Permissions')]));
    }

    public function edit($id)
    {
        $this->authorize('manage permissions');
        
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('manage permissions');
        
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->all();


        $user = Permission::find($id);
        $user->update($input);

        return redirect()->route('permission.index')
            ->with('success', __('success.updated', ['item' => __('Permissions')]));
    }
    public function destroy($id)
    {
        $this->authorize('manage permissions');
        
        $permission = Permission::findOrFail($id);
        $permission->delete();

        if (request()->header('HX-Request')) {
            return response('', 200);
        }

        return redirect()->route('permission.index')->with('success', __('success.deleted', ['item' => __('Permissions')]));
    }

}
