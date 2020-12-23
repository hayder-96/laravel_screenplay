<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\MainScreenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterandLogin;
use App\Http\Controllers\SceneController;
use App\Http\Controllers\usersController;
use App\Http\Controllers\UsersController as ControllersUsersController;
use App\Models\MainScreen;
use Illuminate\Http\Request;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('Register',[RegisterandLogin::class,'Register']);
Route::post('Login',[RegisterandLogin::class,'login']);


Route::middleware('auth:api')->group(function(){

    
    Route::resource('screen',MainScreenController::class);
    Route::resource('scene',SceneController::class);
    Route::get('getscene/delete/{id}',[SceneController::class,'index']);
    Route::resource('users',ProfileController::class);
    Route::get('getusers',[ProfileController::class,'indexOne']);
    Route::get('getusersyes/{id}',[ProfileController::class,'indexyes']);
    Route::get('getscreenuser/show/{id}',[MainScreenController::class,'getProfile']);
    Route::resource('message',MessageController::class);
    Route::get('Messages',[MessageController::class,'getMessage']);
    
    Route::resource('friend',FriendController::class);
    
});


Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();
});
