<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\JoinEventController;
use App\Http\Controllers\API\CategoryEventController;

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

Route::middleware('auth:sanctum')->group(function(){
    //User
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('user/photo', [UserController::class, 'updatePhoto']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('getUserId',[UserController::class,'getUserId']);
    Route::get('getAllUser',[UserController::class,'getAllUser']);


    //Event
    Route::get('event', [EventController::class, 'all']);
    Route::post('event', [EventController::class,'addEvent']);
    Route::post('updateEvent', [EventController::class,'update']);
    Route::delete('deleteEvent', [EventController::class,'delete']);
    Route::post('updatePoster', [EventController::class,'updatePoster']);

    //Category
    Route::get('category', [CategoryEventController::class, 'getCategory']);
    Route::post('category', [CategoryEventController::class, 'add']);
    Route::post('updateCategory', [CategoryEventController::class, 'update']);
    Route::delete('deleteCategory', [CategoryEventController::class, 'delete']);
    
    //JoinEvent
    Route::post('join', [JoinEventController::class, 'join']);
    Route::get('join', [JoinEventController::class, 'all']);


});

// getAllUser
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
