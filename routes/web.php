<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/messages',[App\Http\Controllers\ChatController::class,'savemessage']);
    Route::post('/user_messages',[App\Http\Controllers\ChatController::class,'get_messages']);
    Route::get('/chat',[App\Http\Controllers\ChatController::class,'index'])->name('chat');
    Route::get('/users',[App\Http\Controllers\ChatController::class,'get_users']);
    Route::get('/online-users',[App\Http\Controllers\ChatController::class,'online_users']);
    Route::get('/get_user',[App\Http\Controllers\ChatController::class,'get_user']);
});

Route::fallback(function () {
    abort(404);
});