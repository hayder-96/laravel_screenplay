<?php

use App\Http\Controllers\CodeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\forget;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ImageprofileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MainScreenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterandLogin;
use App\Http\Controllers\SceneController;
use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UpimageController;
use Illuminate\Support\Facades\Route;


Route::post('Register',[RegisterandLogin::class,'Register']);
Route::post('Login',[RegisterandLogin::class,'login']);


Route::post('logFace',[RegisterandLogin::class,'LoginFacebook']);



Route::resource('code',CodeController::class);
Route::get('getpoo/{name}',[CodeController::class,'getcode']);



 Route::resource('Forgot',forget::class);


Route::middleware('auth:api')->group(function(){

    
    
    Route::post('uppass',[forget::class,'insertpas']);





    Route::post('getimage',[MainScreenController::class,'imageLoad']);
    Route::resource('screen',MainScreenController::class);
    Route::resource('scene',SceneController::class);
    Route::get('getscene/delete/{id}',[SceneController::class,'index']);
    Route::resource('users',ProfileController::class);
    Route::get('getusers',[ProfileController::class,'indexOne']);
     


    
    Route::resource('getimageprofile',ImageprofileController::class);




    Route::resource('upimage',UpimageController::class);
    Route::get('getima/image/{id}',[UpimageController::class,'getim']);


    Route::get('getusersyes/{id}',[ProfileController::class,'indexyes']);
    Route::get('getscreenuser/show/{id}',[MainScreenController::class,'getProfile']);
    Route::resource('message',MessageController::class);
    Route::get('Messages',[MessageController::class,'getMessage']);
    
    Route::resource('friend',FriendController::class);
    Route::post('getfriend',[FriendController::class,'input']);
    Route::get('getitemfriend/show/{id}',[FriendController::class,'getItem']);


    Route::resource('like',LikeController::class);
    Route::get('getlike/show/{id}',[LikeController::class,'getcount']);
    Route::get('getlikeuser/show/{id}',[LikeController::class,'index']);



    Route::resource('comment',CommentController::class);


    Route::get('getcomment/show/{id}',[CommentController::class,'indexx']);
    Route::get('getitemcomment/show/{id}',[CommentController::class,'indexcom']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();
});
