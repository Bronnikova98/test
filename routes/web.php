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


Auth::routes();

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
Route::post('/{post}/comment/store', [App\Http\Controllers\PostController::class, 'storeComment'])->name('posts.comments.store');
Route::delete('/{post}/comment/{comment}', [App\Http\Controllers\PostController::class, 'destroyComment'])->name('posts.comments.destroy');
Route::put('/{post}/comment/{comment}/update', [App\Http\Controllers\PostController::class, 'updateComment'])->name('posts.comments.update');

Route::middleware(['auth'])->group(function () {
    Route::get('profile', [App\Http\Controllers\Profile\UserController::class, 'index'])->name('profile');
    Route::resource('profile/posts', App\Http\Controllers\Profile\PostController::class, ['as' => 'profile']);

    Route::get('profile/{user}/edit', [App\Http\Controllers\Profile\UserController::class, 'edit'])->name('profile.edit');
    Route::put('profile/{user}', [App\Http\Controllers\Profile\UserController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin-panel')->group(function () {
    Route::resource('users', App\Http\Controllers\UserController::class);

    Route::get('users/{user}/edit', [App\Http\Controllers\UserController::class, 'edit'])
        ->middleware(\App\Http\Middleware\UserUpdateMiddleware::class)->name('users.edit');

    Route::get('users/{user}', [App\Http\Controllers\UserController::class, 'update'])
        ->middleware(\App\Http\Middleware\UserUpdateMiddleware::class);

    Route::resource('admin/posts', App\Http\Controllers\Admin\PostController::class, ['as' => 'admin']);

    Route::resource('admin/comments', App\Http\Controllers\Admin\CommentController::class, ['as' => 'admin']);
});

