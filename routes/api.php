<?php

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

//Post API
Route::get('/posts', [PostController::class,'index']);
Route::post('/post', [PostController::class,'store']);
Route::get('/posts/{id}', [PostController::class,'show']);
Route::put('/posts/{id}', [PostController::class,'update']);
Route::delete('/posts/{id}', [PostController::class,'destroy']);

//Store API
Route::get('/stores',[StoreController::class,'index']);
Route::post('/store',[StoreController::class,'store']);
Route::get('/stores/{id}',[StoreController::class,'show']);
Route::put('/stores/{id}',[StoreController::class,'update']);
Route::delete('/stores/{id}',[StoreController::class,'destroy']);

//Item API
Route::get('/items',[ItemController::class,'index']);
Route::post('/item',[ItemController::class,'store']);
Route::get('/items/{id}',[ItemController::class,'show']);
Route::put('/items/{id}',[ItemController::class,'update']);
Route::delete('/items/{id}',[ItemController::class,'destroy']);

//Comment API
Route::get('/comments',[CommentController::class,'index']);
Route::post('/comment',[CommentController::class,'store']);
Route::get('/comments/{id}',[CommentController::class,'show']);
Route::put('/comments/{id}',[CommentController::class,'update']);
Route::delete('/comments/{id}',[CommentController::class,'destroy']);
