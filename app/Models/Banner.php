<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'title',
        'location',
        'distance',
        'latitude',
        'longitude',
        'image_path',
        'status',
    ];
}
