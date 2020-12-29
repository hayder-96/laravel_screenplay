<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    use HasFactory;

   
    protected $fillable = [
        'main_screen_id',
        'name',
        'image',
        'country',
        'user_id'
    ];


    
    public function MainScreen()
    {
        return $this->belongsTo('App\Models\MainScreen');
    }

    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
    
}
