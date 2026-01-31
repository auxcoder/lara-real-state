<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::with('permissions')->latest()->paginate(15);
        return view('admin.roles.index', compact('roles'));
    }

    public function create(){
        return view('admin.roles.create');
    }

    public function store(Request $request){
           $this->validate($request, [
            'name' => 'required|unique:roles,name',
         ]);


        $role = Role::create(['name' => $request->input('name')]);

        return redirect()->back()->with('success','Role created successfully');
    }

    public function show($id){
        $data['role'] = Role::find($id);
        return view('admin.roles.show', $data);
    }


    public function edit($id)
    {
        $roles = Role::find($id);
        return view('admin.roles.edit', compact('roles'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);

        $role = Role::find($id);
        // return $role;
        $role->name = $request->input('name');
        $role->save();

        return redirect()->route('roles.index')
        ->with('success','Role updated successfully');
}

    public function destroy($id){
        $role = Role::find($id);
        $role->delete();

        if (request()->header('HX-Request')) {
            return response('', 200);
        }

        return redirect()->back()->with('success','Role Deleted successfully');
    }

}
