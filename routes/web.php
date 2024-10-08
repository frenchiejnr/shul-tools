<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ShulMembersController;
use App\Http\Controllers\UsersController;
use App\Models\ShulMembers;
use Illuminate\Support\Facades\Auth;

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
    Route::get('/members/create', [ShulMembersController::class, 'create'])->can('create', 'App\Models\ShulMembers');
    Route::get('/members/{member:id}/edit', [ShulMembersController::class, 'edit']);
    Route::post('/members', [ShulMembersController::class, 'store']);
    Route::post('/members/{member:id}/edit', [ShulMembersController::class, 'editUser']);
});
