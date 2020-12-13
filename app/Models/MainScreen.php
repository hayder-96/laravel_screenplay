<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainScreen extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'image',
        'user_id'
    ];


    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    
}
