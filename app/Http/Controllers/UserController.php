<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('roles')->get();
            $data = [];
            
            foreach ($users as $user) {
                $data[] = [
                    'user_id' => $user->user_id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->roles ? $user->roles->name : 'No Role',
                    'company' => $user->company,
                    'phone_number' => $user->phone_number,
                    'status' => $user->status ? 'Active' : 'Inactive',
                    'last_signin' => $user->last_signin ? $user->last_signin->format('Y-m-d H:i') : 'Never',
                    'actions' => $this->generateActionButtons($user)
                ];
            }
            
            return response()->json(['data' => $data]);
        }
        
        $users = User::with('roles')->get(); 
        return view('dashboard-user.index', compact('users'));
    }

    public function create(){
        // $roles = ['Admin', 'Member', 'Startup Owner', 'Mentor'];
        $roles = Role::pluck('name', 'role_id');
        return view('dashboard-user.create', compact('roles'));
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

        ]);

        // dd($request->all());

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'company' => $request->company,
            'phone_number' => $request->phone_number,
            'last_signin' => null, // Default null, akan diperbarui saat login
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        $currentUser = Auth::user();
        
        if (!$currentUser->canManageUsers()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        }
        
        $user = User::findOrFail($id);
        
        // Prevent deletion of business owners
        if ($user->isBusinessOwner()) {
            return response()->json(['success' => false, 'message' => 'Cannot delete business owner']);
        }
        
        $user->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    }

    /**
     * Generate action buttons for DataTables
     */
    private function generateActionButtons($user)
    {
        $currentUser = Auth::user();
        $buttons = '';
        
        // Show promote button for staff if current user can manage users
        if ($currentUser && $currentUser->canManageUsers() && $user->isStaff()) {
            $buttons .= '<button class="btn btn-sm btn-primary me-1" onclick="promoteUser(' . $user->user_id . ')">
                            <i class="fas fa-user-plus"></i> Promote
                        </button>';
        }
        
        // Show delete button if current user can manage users and target is not business owner
        if ($currentUser && $currentUser->canManageUsers() && !$user->isBusinessOwner()) {
            $buttons .= '<button class="btn btn-sm btn-danger" onclick="deleteUser(' . $user->user_id . ')">
                            <i class="fas fa-trash"></i> Delete
                        </button>';
        }
        
        return $buttons ?: '<span class="text-muted">No actions</span>';
    }

    /**
     * Promote a staff user to administrator
     */
    public function promote(Request $request, $userId)
    {
        $currentUser = Auth::user();
        
        if (!$currentUser->canManageUsers()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        }
        
        $user = User::findOrFail($userId);
        
        if (!$user->isStaff()) {
            return response()->json(['success' => false, 'message' => 'Only staff members can be promoted']);
        }
        
        if ($user->promoteTo('administrator')) {
            return response()->json(['success' => true, 'message' => 'User promoted to administrator successfully']);
        }
        
        return response()->json(['success' => false, 'message' => 'Failed to promote user']);
    }
}