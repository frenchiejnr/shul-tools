<?php

namespace App\Http\Controllers;

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
                ->select('shul_members.*')
                ->join('ancestors', 'shul_members.ancestors_id', '=', 'ancestors.id')
                ->addSelect('ancestors.*')
                ->addSelect('shul_members.id as member_id')
                ->when(Request::input('search'), function ($query, $search) {
                    $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('hebrew_name', 'like', "%{$search}%")
                        ->orWhere('fathers_hebrew_name', 'like', "%{$search}%")
                        ->orWhere('mothers_hebrew_name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($member) => [
                    'name' => $member->name,
                    'hebrew_name' => $member->hebrew_name,
                    'gender' => $member->gender,
                    'fathers_hebrew_name' => $member->fathers_hebrew_name,
                    'mothers_hebrew_name' => $member->mothers_hebrew_name,
                    'id' => $member->member_id,
                    'ancestors_id' => $member->ancestors_id,

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
    public function edit(int $id)
    {
        return Inertia::render('Members/Edit', [
            'member' => ShulMembers::where('shul_members.id', $id)
                ->join('ancestors', 'shul_members.ancestors_id', '=', 'ancestors.id')
                ->select(
                    'shul_members.id',
                    'name',
                    'hebrew_name',
                    'gender',
                    'ancestors.fathers_hebrew_name',
                    'ancestors.paternal_grandfather_hebrew_name',
                    'ancestors.paternal_grandmother_hebrew_name',
                    'ancestors.mothers_hebrew_name',
                    'ancestors.maternal_grandfather_hebrew_name',
                    'ancestors.maternal_grandmother_hebrew_name',
                )
                ->first()

        ]);
    }

    public function editUser(int $id)
    {
        $member = ShulMembers::findOrFail($id);
        $data = Request::validate([
            'name' => ['required', 'max:255'],
            'hebrew_name' => ['required', 'max:255'],
            'gender' => ['required'],
            'fathers_hebrew_name' => ['required', 'max:255'],
            'mothers_hebrew_name' => ['required', 'max:255'],
            'paternal_grandfather_hebrew_name' => ['required', 'max:255'],
            'paternal_grandmother_hebrew_name' => ['required', 'max:255'],
            'maternal_grandfather_hebrew_name' => ['required', 'max:255'],
            'maternal_grandmother_hebrew_name' => ['required', 'max:255'],
        ]);
        $member->ancestors()->update([
            'fathers_hebrew_name' => $data['fathers_hebrew_name'],
            'mothers_hebrew_name' => $data['mothers_hebrew_name'],
            'paternal_grandfather_hebrew_name' => $data['paternal_grandfather_hebrew_name'],
            'paternal_grandmother_hebrew_name' => $data['paternal_grandmother_hebrew_name'],
            'maternal_grandfather_hebrew_name' => $data['maternal_grandfather_hebrew_name'],
            'maternal_grandmother_hebrew_name' => $data['maternal_grandmother_hebrew_name'],
        ]);
        $member->update($data);
        return redirect('/members');
    }
}
