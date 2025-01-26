<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RestItemController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// authentication  
Route::post('/login', [AuthController::class, 'login']);  // log in comtpe   
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // logout of compte 
Route::put('/users/{id}', [AuthController::class, 'update'])->middleware('auth:sanctum'); // update the user profile 
Route::post('/users', [AuthController::class, 'register']); // register new compte
Route::prefix('items')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/store', [RestItemController::class, 'store']);
        Route::get('{id}', [RestItemController::class, 'show']);
        Route::post('{id}/menu', [MenuController::class, 'store']);
        Route::put('{id}', [RestItemController::class, 'update']);  // correct
        Route::delete('{id}', [RestItemController::class, 'destroy']);   // correct
    });
    // category 
    Route::post('/category', [RestItemController::class, 'itemsCategory']); // show the items of each category we want 
    Route::get('/', [RestItemController::class, 'index']);
    Route::get('image/{filename}', [RestItemController::class, 'show_image']);
});

// all of menu functions
Route::get('menu', [MenuController::class, 'index']);
// user 
Route::get('/users', [UserController::class, 'index']);  // show all of users 


Route::prefix('posts')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [PostController::class, 'store']);   // store the post
        Route::get('/user', [PostController::class, 'indexUser']);  // show the user post 
        // Route::put('{id}', [PostController::class, 'edit']);  // update the post
      
        Route::delete('{id}', [PostController::class, 'destroy']);  // destroy the post
    });
    Route::get('/', [PostController::class, 'index']);
    Route::get('{filename}', [RestItemController::class, 'show_image']);
});
