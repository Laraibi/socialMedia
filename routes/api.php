<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PersonneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\uploadController;
use App\Http\Controllers\UserController;
// use BookController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');


route::resource('messages',MessageController::class)->middleware('auth:sanctum');
route::get('messageDetails',[MessageController::class,'getMessageDetails'])->middleware('auth:sanctum');
route::post('sendMessage',[MessageController::class,'sendMessage'])->middleware('auth:sanctum');
route::get('getDisscussion',[MessageController::class,'getDisscussion'])->middleware('auth:sanctum');
route::get('users',[UserController::class,'getUsers'])->middleware('auth:sanctum');
route::get('getUser',[UserController::class,'getUser'])->middleware('auth:sanctum');
route::post('editProfile',[UserController::class,'editProfile'])->middleware('auth:sanctum');
route::post('uploadImage',[uploadController::class,'uploadImage']);