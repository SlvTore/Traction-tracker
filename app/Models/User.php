<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id'; // Mengubah primary key dari default 'id' ke 'user_id'

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'company',
        'role_id',
        'description',
        'status',
        'last_signin',
        'created_id',
        'update_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function businesses()
    {
        return $this->belongsToMany(Business::class, 'business_user', 'user_id', 'business_id');
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole(string $roleName): bool
    {
        return $this->roles && $this->roles->name === $roleName;
    }

    /**
     * Promote user to a specific role
     */
    public function promoteTo(string $roleName): bool
    {
        $role = Role::where('name', $roleName)->first();
        if ($role) {
            $this->role_id = $role->role_id;
            return $this->save();
        }
        return false;
    }

    /**
     * Check if user is business owner
     */
    public function isBusinessOwner(): bool
    {
        return $this->hasRole('business-owner');
    }

    /**
     * Check if user is administrator
     */
    public function isAdministrator(): bool
    {
        return $this->hasRole('administrator');
    }

    /**
     * Check if user is staff
     */
    public function isStaff(): bool
    {
        return $this->hasRole('staff');
    }

    /**
     * Check if user is business investigator
     */
    public function isBusinessInvestigator(): bool
    {
        return $this->hasRole('business-investigator');
    }

    /**
     * Check if user can manage other users
     */
    public function canManageUsers(): bool
    {
        return $this->isBusinessOwner() || $this->isAdministrator();
    }
}
