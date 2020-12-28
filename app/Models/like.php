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
        'country'
    ];


    
    public function MainScreen()
    {
        return $this->belongsTo('App\Models\MainScreen');
    }
    
}
