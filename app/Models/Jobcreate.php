<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobcreate extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',          
        'email',  
        'mobile_no',  
        'c_name',  
        'details',  
        'contact_person',  
        'exp',  
        'status',
        'domain',       
        'location',       
        'is_c_name',       
        'is_email',       
        'is_mobile', 
        'is_contact_person',     
        'job_id',
        'no_position',
        'end_data'
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
