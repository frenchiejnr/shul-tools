<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ShulMembersController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\AdminUser;

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');


Route::inertia('/', 'Home');
Route::middleware('auth')->group(function () {
    Route::inertia('/settings', 'Settings');

    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/users/create', [UsersController::class, 'create'])->can('create', 'App\Models\User');
    Route::post('/users', [UsersController::class, 'store']);

    Route::get('/members', [ShulMembersController::class, 'index']);
    Route::post('/members', [ShulMembersController::class, 'store']);
    Route::post('/members/{member:id}/edit', [ShulMembersController::class, 'editUser']);
});

Route::middleware(AdminUser::class)->group(function () {
    Route::get('/members/create', [ShulMembersController::class, 'create']);
    Route::get('/members/{member:id}/edit', [ShulMembersController::class, 'edit']);
    Route::get('/members/yahrzeits', [ShulMembersController::class, 'yahrzeit']);
    Route::get('/members/sendYahrzeits', [ShulMembersController::class, 'sendYahrzeits']);
});
