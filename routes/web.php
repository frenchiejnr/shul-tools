<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UsersController;
use App\Models\ShulMembers;
use Illuminate\Support\Facades\Auth;

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::inertia('/', 'Home');
    Route::inertia('/settings', 'Settings');

    Route::get('/users', [UsersController::class, 'index']);
    Route::get('/users/create', [UsersController::class, 'create'])->can('create', 'App\Models\User');
    Route::post('/users', [UsersController::class, 'store']);


    Route::get('/members', function () {
        return Inertia::render('Members/Index', [
            'members' => ShulMembers::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('hebrew_name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($member) => [
                    'name' => $member->name,
                    'hebrew_name' => $member->hebrew_name,
                    'gender' => $member->gender,
                    'id' => $member->id,
                    'can' => [
                        'edit' => Auth::user()->can('edit', $member)
                    ]
                ]),
            'filters' => Request::only(['search']),
            'can' => [
                'createMember' => Auth::user()->can('create', ShulMembers::class)
            ]
        ]);
    });
});
