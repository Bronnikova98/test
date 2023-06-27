<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'role:admin|user'])->prefix('home')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin-panel')->group(function () {
    Route::resource('users', App\Http\Controllers\UserController::class)->middleware('role:admin');
});

Auth::routes();


