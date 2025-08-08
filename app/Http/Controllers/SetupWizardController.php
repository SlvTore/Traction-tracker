<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Business;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SetupWizardController extends Controller
{
    public function show()
    {
        $roles = Role::whereIn('name', ['business-owner', 'staff', 'business-investigator'])->get();
        return view('auth.wizard', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:business-owner,staff,business-investigator',
            'company' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $role = Role::where('name', $request->role)->first();
        
        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company' => $request->company,
            'phone_number' => $request->phone_number,
            'role_id' => $role->role_id,
        ]);

        // Handle business owner setup
        if ($request->role === 'business-owner') {
            $business = Business::create([
                'business_name' => $request->company ?? $request->name . "'s Business",
                'date' => now()->toDateString(),
            ]);

            $business->generatePublicId();
            $business->generateInvitationCode();
            
            // Attach user to business
            $user->businesses()->attach($business->id);
        }

        Auth::login($user);

        return response()->json([
            'success' => true,
            'role' => $request->role,
            'redirect_url' => route('dashboard')
        ]);
    }

    public function validateBusinessAccess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'public_id' => 'required|string',
            'invitation_code' => 'required_if:role,staff|string|nullable',
            'role' => 'required|in:staff,business-investigator'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $business = Business::where('public_id', $request->public_id)->first();

        if (!$business) {
            return response()->json(['success' => false, 'message' => 'Invalid Business ID']);
        }

        // For staff, validate invitation code
        if ($request->role === 'staff') {
            if ($business->invitation_code !== $request->invitation_code) {
                return response()->json(['success' => false, 'message' => 'Invalid invitation code']);
            }
        }

        // Attach user to business
        $user = Auth::user();
        $user->businesses()->attach($business->id);

        return response()->json(['success' => true, 'message' => 'Successfully joined business!']);
    }
}