<?php

use Illuminate\Support\Facades\Route;   
use \App\Http\Controllers\UserController; 
use \App\Http\Controllers\PostController; 
use \App\Http\Controllers\ImageController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/post/create', [App\Http\Controllers\PostController::class, 'formPost']);
Route::post('/post', [App\Http\Controllers\PostController::class, 'store']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/list/user', [App\Http\Controllers\UserController::class, 'list'])->name('list');
Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'details'])->name('details');
Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'details'])->name('details');
Route::get('/follow/{id}', [App\Http\Controllers\UserController::class, 'follow'])->name('follow');
Route::get('/unfollow/{id}', [App\Http\Controllers\UserController::class, 'unfollow'])->name('unfollow');
Route::get('/like/{id}', [App\Http\Controllers\PostController::class, 'like']);
Route::get('/dislike/{id}', [App\Http\Controllers\PostController::class, 'dislike']);
Route::post('/comment', [App\Http\Controllers\CommentController::class, 'create']);