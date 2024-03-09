<?php

namespace App\Http\Controllers;

use App\Helpers\PermissionHelper;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Traits\HasPermissionsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    use HasPermissionsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $this->authorizeUser('User','view-any');
        $currentUser = auth()->user();
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users','currentUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        $this->authorizeUser('User','create');
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorizeUser('User','create');

        $validated = $request->validated();

        try {
            $user = new User();

            $user->fill($validated);

            $user->password = Hash::make($validated['password']);

            $user->save();

            return redirect()->route('users.index')->with('success', 'User created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorizeUser('User','edit');
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorizeUser('User','edit');

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        try {
            $user->update($validated);
            return redirect()->route('users.index')->with('success', 'User updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorizeUser('User','delete');
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
