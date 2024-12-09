<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShulMembersController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\AdminUser;

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');


Route::inertia('/', 'Home');
Route::middleware('auth')->group(function () {
    Route::get('/settings', [SettingsController::class, 'index']);

    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/users/create', [UsersController::class, 'create']);
    Route::post('/users', [UsersController::class, 'store']);

    Route::get('/members', [ShulMembersController::class, 'index']);
});

Route::middleware(AdminUser::class)->group(function () {
    Route::get('/members/create', [ShulMembersController::class, 'create']);
    Route::post('/members', [ShulMembersController::class, 'store']);
    Route::get('/members/{member:id}/edit', [ShulMembersController::class, 'edit']);
    Route::post('/members/{member:id}/edit', [ShulMembersController::class, 'editUser']);
    Route::get('/members/yahrzeits', [ShulMembersController::class, 'yahrzeit']);
    Route::post('/members/sendYahrzeits', [ShulMembersController::class, 'sendYahrzeits']);
});
