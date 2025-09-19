<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // Permissions middleware for actions
        $this->middleware('can:user_view')->only(['index', 'show']);
        $this->middleware('can:user_create')->only(['create', 'store']);
        $this->middleware('can:user_edit')->only(['edit', 'update']);
        $this->middleware('can:user_delete')->only(['destroy']);
    }

    // List all users
    public function index(Request $request)
    {
        $users = User::latest()->get();
        $selectedUser = null;

        if ($request->has('selected')) {
            $selectedUser = User::with('roles')->find($request->selected);
        }

        return view('backend.users.index', compact('users', 'selectedUser'));
    }

    // Show create user form
    public function create()
    {
        $roles = Role::pluck('name');
        return view('backend.users.create', compact('roles'));
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role
        $user->assignRole($request->role);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Show edit user form
    public function edit(User $user)
    {
        $roles = Role::pluck('name');
        return view('backend.users.edit', compact('user', 'roles'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'nullable|string', // comma-separated roles
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Sync roles if provided
        if ($request->has('roles')) {
            $roleNames = array_filter(array_map('trim', explode(',', $request->roles)));
            $user->syncRoles($roleNames);
        }

        if ($request->ajax()) {
            return response()->json($user);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    


    // Delete user
    public function destroy(Request $request, User $user)
    {
        $user->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    // Optional: Show user details (if needed)
    public function show(User $user)
    {
        return view('backend.users.show', compact('user'));
    }
}
