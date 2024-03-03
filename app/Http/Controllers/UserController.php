<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        if ($user->cannot('view-any', User::class)) {
            abort(403);
        }
        $currentUser = auth()->user();
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users','currentUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        if ($user->cannot('create', User::class)) {
            abort(403);
        }
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    if ($request->user()->cannot('create', User::class)) {
        abort(403);
    }

    $validated = $request->validate([
        'name' => 'required|string',
        'username' => 'required|unique:users',
        'role_id' => 'required|exists:roles,id',
        'phone' => 'required|string',
        'email' => 'required|email|unique:users',
        'address' => 'nullable|string',
        'password' => 'required|string',
        'gender' => ['required', Rule::in(['0', '1'])],
        'is_active' => 'required|boolean'
    ]);

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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        if ($user->cannot('edit', User::class)) {
            abort(403);
        }

        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->user()->cannot('edit', User::class)) {
            abort(403);
        }

        $validated = $request->validate([
            'name' =>'required|string',
            'username' => ['required', Rule::unique('users')->ignore($id)],
            'role_id' =>'required|exists:roles,id',
            'phone' =>'required|string',
            'email' => ['required', 'email', Rule::unique('users')->ignore($id)],
            'address' => 'nullable|string',
            'password' => 'nullable|string',
            'gender' => ['required', Rule::in(['0', '1'])],
            'is_active' =>'required|boolean'
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        try {
            $user = User::findOrFail($id);
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
        if ($user->cannot('delete', User::class)) {
            abort(403);
        }
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'User deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
