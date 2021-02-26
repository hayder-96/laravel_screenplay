<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    			
    protected $fillable = [
        'user_id',
        'main_screen_id',
        'parent_id',
        'descreption',
        'name',
        'image',
        'enable'
    ];

    
    public function user()
    {
        return $this->belongsToMany('App\Models\User');

    }
    

    
    public function comments()
    {
        return $this->hasMany('App\Models\Comment','parent_id');
    }
    

}