<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAccess extends Model
{
    use HasFactory;

    protected $primaryKey = 'master_access_id'; // Ubah primary key menjadi master_access_id
    protected $fillable = ['name', 'description', 'status'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_access', 'master_access_id', 'role_id');
    }
}
