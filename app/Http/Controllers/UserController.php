<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get(); 
        
        // Check if request is for dashboard-users or legacy dashboard-user
        if (request()->routeIs('dashboard.users')) {
            return view('dashboard-users.index', compact('users'));
        }
        
        return view('dashboard-user.index', compact('users')); // Legacy route
    }

    public function create(){
        $roles = Role::pluck('name', 'role_id');
        
        // Check if request is for dashboard-users or legacy users
        if (request()->routeIs('dashboard.users.create')) {
            return view('dashboard-users.create', compact('roles'));
        }
        
        return view('dashboard-user.create', compact('roles')); // Legacy route
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,role_id',
            'company' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20|regex:/^[0-9+]+$/',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'company' => $request->company,
            'phone_number' => $request->phone_number,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0,
            'last_signin' => null, // Default null, akan diperbarui saat login
        ]);

        return redirect()->route('dashboard.users')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::where('user_id', $id)->firstOrFail();
        $roles = Role::all();
        
        // Check if request is for dashboard-users or legacy users
        if (request()->routeIs('dashboard.users.edit')) {
            return view('dashboard-users.edit', compact('user', 'roles'));
        }
        
        return view('user.edit', compact('user', 'roles')); // Legacy route
    }

    public function update(Request $request, $id)
    {
        $user = User::where('user_id', $id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->user_id, 'user_id')],
            'role_id' => 'required|exists:roles,role_id',
            'password' => 'nullable|min:6',
            'phone_number' => 'nullable|string|max:20|regex:/^[0-9+]+$/',
            'company' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'phone_number' => $request->phone_number,
            'company' => $request->company,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('dashboard.users')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::where('user_id', $id)->firstOrFail();
        $user->delete();

        return redirect()->route('dashboard.users')->with('success', 'User berhasil dihapus');
    }
}