<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    use HasFactory;

    protected $table = 'metrics';

    protected $fillable = [
        'title',
        'date',
        'value',
        'status',
        'notes',
        'change_percentage',
        'created_id',
        'update_id',
    ];
}
