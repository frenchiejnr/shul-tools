<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShulMembersController;
use App\Http\Controllers\SuperSettingsController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\AdminUser;
use App\Http\Middleware\SuperAdminUser;
use App\Http\Controllers\SettingsKeysController;
use App\Http\Controllers\TenantsController;

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');


Route::inertia('/', 'Home');

Route::middleware(SuperAdminUser::class)->group(function () {
    Route::get('/settings/super', [SuperSettingsController::class, 'index']);
    Route::post('/settingsKeys', [SettingsKeysController::class, 'store']);
    Route::post('/tenants', [TenantsController::class, 'store']);
    Route::post('/settingsKeys/{setting:id}/edit', [SettingsKeysController::class, 'edit']);
    Route::post('/tenants/{tenant:id}/edit', [TenantsController::class, 'edit']);
    Route::delete('/settingsKeys/{setting:id}/delete', [SettingsKeysController::class, 'delete']);
    Route::delete('/tenants/{tenant:id}/delete', [TenantsController::class, 'delete']);
    Route::post('/users/{user:id}/makeAdmin', [UsersController::class, 'makeAdmin']);
});

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
    Route::post('/settings', [SettingsController::class, 'store']);
    Route::post('/settings/{setting:id}/edit', [SettingsController::class, 'edit']);
    Route::delete('/settings/{setting:id}/delete', [SettingsController::class, 'delete']);
});
