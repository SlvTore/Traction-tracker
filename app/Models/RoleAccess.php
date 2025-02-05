<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAccess extends Model
{
    use HasFactory;

    protected $table = 'role_access'; // Tentukan nama tabel karena ini tabel pivot
    public $timestamps = true;

    protected $fillable = ['role_id', 'master_access_id'];
}
