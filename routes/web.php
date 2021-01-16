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
Route::post('/cancel-or-delete', [App\Http\Controllers\UsersRelationshipsController::class, 'deleteRelation']);
Route::post('/home/user/cancel-or-delete', [App\Http\Controllers\UsersRelationshipsController::class, 'deleteRelation']);

Route::post('/user/add-to-friend', [App\Http\Controllers\UsersRelationshipsController::class, 'create']);
Route::post('/home/user/add-to-friend', [App\Http\Controllers\UsersRelationshipsController::class, 'create']);

Route::post('/get-users-with-any-relationships', [App\Http\Controllers\UsersRelationshipsController::class, 'getUsersWithRelations']);
Route::post('/home/get-users-with-any-relationships', [App\Http\Controllers\UsersRelationshipsController::class, 'getUsersWithRelations']);

Route::get('friends', [App\Http\Controllers\UsersRelationshipsController::class, 'getFriends']);
Route::get('home/friends', [App\Http\Controllers\UsersRelationshipsController::class, 'getFriends']);

Route::get('active-requests', [App\Http\Controllers\UsersRelationshipsController::class, 'getFriendRequestPendedUsers']);
Route::get('home/active-requests', [App\Http\Controllers\UsersRelationshipsController::class, 'getFriendRequestPendedUsers']);

Route::get('rejected-requests', [App\Http\Controllers\UsersRelationshipsController::class, 'getRejectedUsers']);
Route::get('home/rejected-requests', [App\Http\Controllers\UsersRelationshipsController::class, 'getRejectedUsers']);


Route::post('/user/reject-request', [App\Http\Controllers\UsersRelationshipsController::class, 'rejectRequest']);
Route::post('/reject-request', [App\Http\Controllers\UsersRelationshipsController::class, 'rejectRequest']);
Route::post('/home/user/reject-request', [App\Http\Controllers\UsersRelationshipsController::class, 'rejectRequest']);


Route::get('/post/{id}', [App\Http\Controllers\PostsController::class, 'index']);
Route::post('/post/store', [App\Http\Controllers\PostsController::class, 'store'])->name('post.store');
