<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = ['business_name', 'date', 'public_id', 'invitation_code'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'business_user', 'business_id', 'user_id');
    }

    public function owner()
    {
        return $this->users()->whereHas('roles', function($query) {
            $query->where('name', 'business-owner');
        })->first();
    }

    /**
     * Generate unique public ID for the business
     */
    public function generatePublicId(): string
    {
        do {
            $publicId = 'BID-' . strtoupper(bin2hex(random_bytes(4)));
        } while (self::where('public_id', $publicId)->exists());
        
        $this->public_id = $publicId;
        $this->save();
        
        return $publicId;
    }

    /**
     * Generate or regenerate invitation code
     */
    public function generateInvitationCode(): string
    {
        $invitationCode = strtoupper(bin2hex(random_bytes(6)));
        $this->invitation_code = $invitationCode;
        $this->save();
        
        return $invitationCode;
    }
}
