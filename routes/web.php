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
Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->middleware('verified')->name('home');

Route::get('/search-user', [App\Http\Controllers\UserLiveSearch::class, 'findUser']);

Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'getUserProfile']);
Route::get('/home/user/{id}', [App\Http\Controllers\UserController::class, 'getUserProfile']);

Route::post('/user/cancel-or-delete', [App\Http\Controllers\UsersRelationshipsController::class, 'deleteRelation']);
Route::post('/home/user/cancel-or-delete', [App\Http\Controllers\UsersRelationshipsController::class, 'deleteRelation']);
Route::post('/user/add-to-friend', [App\Http\Controllers\UsersRelationshipsController::class, 'create']);
Route::post('/home/user/add-to-friend', [App\Http\Controllers\UsersRelationshipsController::class, 'create']);
