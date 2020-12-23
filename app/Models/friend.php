<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class friend extends Model
{
    use HasFactory;



    
    protected $fillable = [
        'id',
        'user_id',
        'name_id',
        'name',
        'country',
        'image',
        'visibl',
    ];



    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    






}
