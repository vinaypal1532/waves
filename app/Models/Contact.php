<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'mobile_no',
        'city',
        'details',
        'qualification',
        'c_name',
        'c_location',
        'y_passing',
        'interested',
    ];
}
