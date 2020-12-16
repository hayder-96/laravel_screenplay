<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'age',
        'image',
        'user_id',
        'gender',
        'country'
    ];


    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
