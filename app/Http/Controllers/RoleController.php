<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionHelper;
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

     protected $pHelper;

     public function __construct()
     {
         $this->pHelper = new PermissionHelper();
     }
    public function index(User $user)
    {
        $this->pHelper->authorizeUser('Role','view-any');
        $roles = Role::all();
        $features = Feature::all();
        return view('roles.index', compact('roles','features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        $this->pHelper->authorizeUser('Role','create');
        $features = Feature::all();
        return view('roles.create', compact('features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->pHelper->authorizeUser('Role','create');

        try {
        $validatedData = $request->validate([
        'role-name' => 'required|string|max:255',
        'permissions' => 'array',
        ]);

        $role = Role::create([
        'name' => $validatedData['role-name'],
        ]);

        if (isset($validatedData['permissions'])) {
        $permissions = Permission::whereIn('id', $validatedData['permissions'])->get();
        $role->permissions()->attach($permissions);
        }

         return redirect()->route('roles.index')->with('success', 'Role created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user,Role $role)
    {
        $this->pHelper->authorizeUser('Role','edit');
        $permissions = Permission::all();
        $features = Feature::all();
        return view('roles.edit', compact('role', 'permissions', 'features'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request,Role $role)
    {
        $this->pHelper->authorizeUser('Role','edit');
        $request->validate([
            'role-name' => 'required|string|max:255',
            'permissions' => 'array',
        ]);

        $role->name = $request->input('role-name');

        $permissionIds = Permission::whereIn('id', $request->input('permissions', []))->get();

        $role->permissions()->sync($permissionIds);

        $role->save();

        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user,Role $role)
    {
        $this->pHelper->authorizeUser('Role','delete');
        if($role->users->count() > 0){
            return redirect()->back()->with('error', 'Role cannot be deleted because it is used by users');
        }
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }
}
