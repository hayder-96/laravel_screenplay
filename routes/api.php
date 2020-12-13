<?php

use App\Http\Controllers\MainScreenController;
use App\Http\Controllers\RegisterandLogin;
use App\Http\Controllers\SceneController;
use App\Models\MainScreen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::get('getscene/{id}',[SceneController::class,'index']);



});


Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();
});
