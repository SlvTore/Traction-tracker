<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetricRecord extends Model
{
    use HasFactory;

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'metric_id',
        'title',
        'value',
        'status',
        'notes',
    ];

    // Relasi dengan model Metric
    public function metric()
    {
        return $this->belongsTo(Metric::class);
    }
}
