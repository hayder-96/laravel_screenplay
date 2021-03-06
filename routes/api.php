<?php

use App\Http\Controllers\AdminController;
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



Route::resource('admin',AdminController::class);






Route::post('logface',[RegisterandLogin::class,'LoginFacebook']);



Route::resource('code',CodeController::class);


Route::get('ussr',[forget::class,'indexxx']);
Route::get('ua',[forget::class,'indexx']);







 Route::resource('Forgot',forget::class);


 Route::post('getcoreg',[CodeController::class,'getcoder']);


 Route::middleware('admin:admin')->group(function(){


    Route::get('getadmin',[AdminController::class,'indexx']);
    
    
 });







 Route::get('getem/{email}',[CodeController::class,'getemail']);

Route::middleware('auth:api')->group(function(){

    Route::post('getpoo',[CodeController::class,'getcode']);
    
    




    Route::post('uppass',[forget::class,'insertpas']);





    Route::post('getimage',[MainScreenController::class,'imageLoad']);
    Route::resource('screen',MainScreenController::class);
    Route::resource('scene',SceneController::class);
    Route::get('getscene/delete/{id}',[SceneController::class,'indexo']);
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
    Route::get('getitemname/{id}',[FriendController::class,'indexname']);












    Route::resource('like',LikeController::class);
    Route::get('getlike/show/{id}',[LikeController::class,'getcount']);
    Route::get('getlikeuser/show/{id}',[LikeController::class,'index']);



    Route::resource('comment',CommentController::class);

    Route::put('commentup/{id}',[CommentController::class,'updateenable']);






    Route::get('getcomment/show/{id}',[CommentController::class,'indexx']);
    Route::get('getitemcomment/show/{id}',[CommentController::class,'indexcom']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();
});


Route::group(['middleware' =>['api','checkPassword','changeLanguage','checkAdminToken:admin-api'],'namespace'=>'Api'], function() {
    //???????? ????????????
});

