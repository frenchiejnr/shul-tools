<?php

namespace App\Http\Controllers;

use App\Models\Ancestors;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\ShulMembers;

class ShulMembersController extends Controller
{
    //

    public function index()
    {
        return Inertia::render('Members/Index', [
            'members' => ShulMembers::query()
                ->join('ancestors', 'shul_members.ancestors_id', '=', 'ancestors.id')
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
                    'fathers_hebrew_name' => $member->fathers_hebrew_name,
                    'mothers_hebrew_name' => $member->mothers_hebrew_name,
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
    }

    public function create()
    {
        return Inertia::render('Members/Create');
    }
    public function store()
    {

        $attributes = Request::validate([
            'name' => ['required', 'max:255'],
            'hebrew_name' => ['required', 'max:255'],
            'gender' => ['required'],
        ]);

        ShulMembers::create($attributes);

        return redirect('/members');
    }
}
