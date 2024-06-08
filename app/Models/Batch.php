<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'rate',
        'details',
        'duration',
        'status',
        'domain_id',
        'image',
        'start_date'
    ];
    public function domain()
    {
        return $this->belongsTo(Topic::class);
    }
}

