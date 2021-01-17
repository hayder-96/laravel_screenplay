<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class upimage extends Model
{
    use HasFactory;




    protected $fillable = [
        'image',
        'film_id',
        'title'
        
    ];


    
    public function MainScreen()
    {
        return $this->belongsTo('App\Models\MainScreen');
    }
    
}
