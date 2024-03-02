<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
         if ($user->cannot('view-any', Role::class)) {
            abort(403);
        }
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Role::all();
        $features = Feature::all();
        return view('roles.create', compact('permissions', 'features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->user()->cannot('create', Role::class)){
            abort(403);
        }

        try {
        $validatedData = $request->validate([
        'role-name' => 'required|string|max:255',
        'permissions' => 'array',
        ]);

        $role = Role::create([
        'name' => $validatedData['role-name'],
        ]);
        if (isset($validatedData['permissions'])) {
        $permissions = Permission::whereIn('name', $validatedData['permissions'])->get();
        $role->permissions()->attach($permissions);
        }

         return redirect()->route('roles.index')->with('success', 'Role created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $features = Feature::all();
        return view('roles.edit', compact('role', 'permissions', 'features'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        if($request->user()->cannot('update', Role::class)){
            abort(403);
        }

        try {
             // Validate the form data
        $validatedData = $request->validate([
        'role-name' => 'required|string|max:255',
        'permissions' => 'array',
        ]);

        $role->update([
        'name' => $validatedData['role-name'],
        ]);
        if (isset($validatedData['permissions'])) {
        $role->permissions()->detach();
        $permissions = Permission::whereIn('name', $validatedData['permissions'])->get();
        $role->permissions()->attach($permissions);
        }

         return redirect()->route('roles.index')->with('success', 'Role created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if($role->users->count() > 0){
            return redirect()->back()->with('error', 'Role cannot be deleted because it is used by users');
        }
        if($role->permissions->count() > 0){
            return redirect()->back()->with('error', 'Role cannot be deleted because it is used by permissions');
        }

        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }
}
