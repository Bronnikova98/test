<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::middleware(['auth'])->prefix('home')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::resource('posts', App\Http\Controllers\PostController::class);
    Route::resource('profile/posts', App\Http\Controllers\Profile\PostController::class, ['as' => 'profile']);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin-panel')->group(function () {
    Route::resource('users', App\Http\Controllers\UserController::class);

    Route::get('users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])
        ->middleware(\App\Http\Middleware\UserUpdateMiddleware::class)->name('users.edit');

    Route::get('users/{user}', [App\Http\Controllers\UserController::class, 'update'])
        ->middleware(\App\Http\Middleware\UserUpdateMiddleware::class);

    Route::resource('admin/posts', App\Http\Controllers\Admin\PostController::class, ['as' => 'admin']);
});

Auth::routes();


