<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imageprofile extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'user_id',
        'image',
       
    ];


    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
}
