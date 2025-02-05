<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'role_id'; // Ubah primary key menjadi role_id
    protected $fillable = ['name', 'description', 'status'];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }

    public function masterAccesses()
    {
        return $this->belongsToMany(MasterAccess::class, 'role_access', 'role_id', 'master_access_id');
    }
}
