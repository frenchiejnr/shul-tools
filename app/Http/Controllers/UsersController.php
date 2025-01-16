<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $tenant_id = Auth::user()->tenant_id;
        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->where('tenant_id', $tenant_id)
                ->when(Request::input('search'), function ($query, $search) {
                    $query
                        ->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'can' => [
                        'edit' => Auth::user()->isAdmin() ?? Auth::user()->can('edit', $user)
                    ]
                ]),
            'filters' => Request::only(['search']),
            'can' => [
                'createUser' => Auth::user()->isAdmin() ?? Auth::user()->can('create', User::class)
            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store()
    {
        $tenant_id = Auth::user()->tenant_id;
        $attributes = Request::validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
        ]);
        $user = new User($attributes);
        $user->tenant_id = $tenant_id;
        $user->save();


        return redirect('/users');
    }

    public function makeAdmin(User $user)
    {
        $user = User::findOrFail($user->id);
        $attributes = Request::validate([
            'admin' => ['required'],
        ]);
        $user->update($attributes);
    }
}
