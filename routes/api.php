<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StoreController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('refresh', [AuthController::class, 'refreshToken']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

//Post API
Route::get('/posts', [PostController::class,'index']);
Route::post('/post', [PostController::class,'store']);
Route::get('/posts/{id}', [PostController::class,'show']);
Route::put('/posts/{id}', [PostController::class,'update']);
Route::delete('/posts/{id}', [PostController::class,'destroy']);

//Stores API
Route::get('/stores',[StoreController::class,'index']);
Route::post('/store',[StoreController::class,'store'])->middleware('auth:api');
Route::get('/stores/{id}',[StoreController::class,'show'])->middleware('auth:api');
Route::put('/stores/{id}',[StoreController::class,'update'])->middleware('auth:api');
Route::delete('/stores/{id}',[StoreController::class,'destroy']);

//Items API
Route::get('/items',[ItemController::class,'index']);
Route::post('/item',[ItemController::class,'store'])->middleware('auth:api');
Route::get('/items/{id}',[ItemController::class,'show'])->middleware('auth:api');
Route::put('/items/{id}',[ItemController::class,'update'])->middleware('auth:api');
Route::delete('/items/{id}',[ItemController::class,'destroy']);

//Comments API
Route::get('/comments',[CommentController::class,'index']);
Route::post('/comment',[CommentController::class,'store'])->middleware('auth:api');
Route::get('/comments/{id}',[CommentController::class,'show'])->middleware('auth:api');
Route::put('/comments/{id}',[CommentController::class,'update'])->middleware('auth:api');
Route::delete('/comments/{id}',[CommentController::class,'destroy']);
