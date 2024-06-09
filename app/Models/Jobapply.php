<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobapply extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',          
        'job_id',  
            
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    
    public function Job()
    {
        return $this->belongsTo(Jobcreate::class);
    }
}
