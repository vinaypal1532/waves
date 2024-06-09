<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studymaterial extends Model
{
    use HasFactory;

    protected $fillable =  [
      
            'title',
            'description',
            'file_path',
            'domain_id',
            'topic_id',
            'type',
            'status'
            ];
            
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
            
}
