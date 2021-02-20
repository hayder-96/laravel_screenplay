<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Cheezykins\LaravelEncryptable\Traits\Encryptable;
class code extends Model
{
   
    use HasFactory,HasFactory,Notifiable;
   


    	
    protected $fillable = [
        'email',
        'code'
       
    ];

    protected $hidden = [
        'code'
        
    ];

    protected $encrypted = [
        'code'
    ];
}
