<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    /**
     * Regenerate invitation code for business
     */
    public function regenerateCode(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isBusinessOwner()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        }
        
        $business = $user->businesses()->first();
        
        if (!$business) {
            return response()->json(['success' => false, 'message' => 'No business found']);
        }
        
        $newCode = $business->generateInvitationCode();
        
        return response()->json([
            'success' => true, 
            'message' => 'Invitation code regenerated successfully',
            'new_code' => $newCode
        ]);
    }
}