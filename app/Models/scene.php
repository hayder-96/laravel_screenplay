<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class scene extends Model
{
    use HasFactory;

    protected $fillable = [
        'numScene',
        'nameScene',
        'contentScene',
        'dialogueScene',
        'main_screen_id',
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
