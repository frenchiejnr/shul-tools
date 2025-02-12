<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\ShulMembers;
use App\Models\Ancestors;
use App\Mail\Yahrzeits;
use Illuminate\Support\Facades\Mail;

class ShulMembersController extends Controller
{
    //

    public function index()
    {
        $sort = Request::input('sort');
        $direction = Request::input('direction', 'asc');

        $tenant_id = Auth::user()->tenant_id;
        $members = ShulMembers::query()
            ->select('shul_members.*')
            ->where('tenant_id', $tenant_id)
            ->join('ancestors', 'shul_members.ancestors_id', '=', 'ancestors.id')
            ->addSelect('ancestors.*')
            ->addSelect('shul_members.id as member_id')
            ->when(Request::input('search'), function ($query, $search) {
                $query
                    ->where('forenames', 'like', "%{$search}%")
                    ->orWhere('surname', 'like', "%{$search}%")
                    ->orWhere('hebrew_name', 'like', "%{$search}%")
                    ->orWhere('fathers_hebrew_name', 'like', "%{$search}%")
                    ->orWhere('mothers_hebrew_name', 'like', "%{$search}%");
            })
            ->when($sort, function ($query, $sort) use ($direction) {
                $query->orderBy($sort, $direction);
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($member) => [
                'forenames' => $member->forenames,
                'surname' => $member->surname,
                'hebrew_name' => $member->hebrew_name,
                'gender' => $member->gender,
                'fathers_hebrew_name' => $member->fathers_hebrew_name,
                'mothers_hebrew_name' => $member->mothers_hebrew_name,
                'id' => $member->member_id,
                'ancestors_id' => $member->ancestors_id,
                'paternal_status' => $member->paternal_status,

                'can' => [
                    'edit' => Auth::user()->isAdmin() ?? Auth::user()->can('edit', $member),
                ]
            ]);

        return Inertia::render('Members/Index', [
            'members' => $members,
            'sort' => $sort,
            'direction' => $direction,
            'filters' => Request::only(['search']),
            'can' => [
                'createMember' => Auth::user()->isAdmin() ?? Auth::user()->can('create', ShulMembers::class),
                'viewYahrzeits' => Auth::user()->isAdmin() ?? Auth::user()->can('yahrzeits', ShulMembers::class)

            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('Members/Create');
    }
    public function store()
    {
        $tenant_id = Auth::user()->tenant_id;
        $data = Request::validate([
            'forenames' => ['required', 'max:255'],
            'surname' => ['required', 'max:255'],
            'hebrew_name' => ['required', 'max:255'],
            'gender' => ['required'],
            'fathers_hebrew_name' => ['required', 'max:255'],
            'mothers_hebrew_name' => ['required', 'max:255'],
            'paternal_grandfather_hebrew_name' => ['required', 'max:255'],
            'paternal_grandmother_hebrew_name' => ['required', 'max:255'],
            'maternal_grandfather_hebrew_name' => ['required', 'max:255'],
            'maternal_grandmother_hebrew_name' => ['required', 'max:255'],
            'paternal_status' => ['required'],
            'maternal_status' => ['required'],
            'contact_email' => ['email:rfc,dns'],
            'father_yahrtzeit_date' => [''],
            'mother_yahrtzeit_date' => [''],

        ]);
        $ancestor = new Ancestors([
            'fathers_hebrew_name' => $data['fathers_hebrew_name'],
            'mothers_hebrew_name' => $data['mothers_hebrew_name'],
            'paternal_grandfather_hebrew_name' => $data['paternal_grandfather_hebrew_name'],
            'paternal_grandmother_hebrew_name' => $data['paternal_grandmother_hebrew_name'],
            'maternal_grandfather_hebrew_name' => $data['maternal_grandfather_hebrew_name'],
            'maternal_grandmother_hebrew_name' => $data['maternal_grandmother_hebrew_name'],
            'maternal_status' => $data['maternal_status'],
            'father_yahrtzeit_date' => in_array('None', $data['father_yahrtzeit_date']) ? null : implode('-', $data['father_yahrtzeit_date']),
            'mother_yahrtzeit_date' => in_array('None', $data['mother_yahrtzeit_date']) ? null : implode('-', $data['mother_yahrtzeit_date'])
        ]);
        $ancestor->save();


        $member = new ShulMembers([
            'forenames' => $data['forenames'],
            'surname' => $data['surname'],
            'hebrew_name' => $data['hebrew_name'],
            'gender' => $data['gender'],
            'paternal_status' => $data['paternal_status'],
        ]);
        $member->ancestors_id = $ancestor->id;
        $member->tenant_id = $tenant_id;
        $member->save();

        return redirect('/members');
    }
    public function edit(int $id)
    {
        $member = ShulMembers::where('shul_members.id', $id)
            ->join('ancestors', 'shul_members.ancestors_id', '=', 'ancestors.id')
            ->select(
                'shul_members.id',
                'forenames',
                'surname',
                'hebrew_name',
                'gender',
                'ancestors.fathers_hebrew_name',
                'ancestors.paternal_grandfather_hebrew_name',
                'ancestors.paternal_grandmother_hebrew_name',
                'ancestors.mothers_hebrew_name',
                'ancestors.maternal_grandfather_hebrew_name',
                'ancestors.maternal_grandmother_hebrew_name',
                'paternal_status',
                'ancestors.maternal_status',
                'ancestors.father_yahrtzeit_date',
                'ancestors.mother_yahrtzeit_date',
                'contact_email',
                'tenant_id',
            )
            ->first();

        if (!$member) {
            abort(404);
        }

        if (Auth::user()->tenant_id != $member->tenant_id) {
            abort(403);
        }

        return Inertia::render('Members/Edit', [
            'member' => $member
        ]);
    }

    public function editUser(int $id)
    {
        $member = ShulMembers::findOrFail($id);
        $data = Request::validate([
            'forenames' => ['required', 'max:255'],
            'surname' => ['required', 'max:255'],
            'hebrew_name' => ['required', 'max:255'],
            'gender' => ['required'],
            'fathers_hebrew_name' => ['required', 'max:255'],
            'mothers_hebrew_name' => ['required', 'max:255'],
            'paternal_grandfather_hebrew_name' => ['required', 'max:255'],
            'paternal_grandmother_hebrew_name' => ['required', 'max:255'],
            'maternal_grandfather_hebrew_name' => ['required', 'max:255'],
            'maternal_grandmother_hebrew_name' => ['required', 'max:255'],
            'paternal_status' => ['required'],
            'maternal_status' => ['required'],
            'contact_email' => ['email:rfc,dns'],
            'father_yahrtzeit_date' => [''],
            'mother_yahrtzeit_date' => [''],

        ]);
        $member->ancestors()->update([
            'fathers_hebrew_name' => $data['fathers_hebrew_name'],
            'mothers_hebrew_name' => $data['mothers_hebrew_name'],
            'paternal_grandfather_hebrew_name' => $data['paternal_grandfather_hebrew_name'],
            'paternal_grandmother_hebrew_name' => $data['paternal_grandmother_hebrew_name'],
            'maternal_grandfather_hebrew_name' => $data['maternal_grandfather_hebrew_name'],
            'maternal_grandmother_hebrew_name' => $data['maternal_grandmother_hebrew_name'],
            'maternal_status' => $data['maternal_status'],
            'father_yahrtzeit_date' => in_array('None', $data['father_yahrtzeit_date']) ? null : implode('-', $data['father_yahrtzeit_date']),
            'mother_yahrtzeit_date' => in_array('None', $data['mother_yahrtzeit_date']) ? null : implode('-', $data['mother_yahrtzeit_date'])
        ]);
        $member->update($data);
        return redirect('/members');
    }

    public function yahrzeit()
    {
        $tenant_id = Auth::user()->tenant_id;
        return Inertia::render(
            'Members/Yahrzeits',
            [
                'member' => ShulMembers::where('tenant_id', $tenant_id)
                    ->where(function ($query) {
                        $query
                            ->whereNotNull('ancestors.mother_yahrtzeit_date')
                            ->orWhereNotNull('ancestors.father_yahrtzeit_date');
                    })
                    ->join('ancestors', 'shul_members.ancestors_id', '=', 'ancestors.id')
                    ->select(
                        'forenames',
                        'surname',
                        'ancestors.fathers_hebrew_name',
                        'ancestors.paternal_grandfather_hebrew_name',
                        'ancestors.mothers_hebrew_name',
                        'ancestors.maternal_grandfather_hebrew_name',
                        'paternal_status',
                        'ancestors.maternal_status',
                        'ancestors.father_yahrtzeit_date',
                        'ancestors.mother_yahrtzeit_date',
                    )
                    ->get()
            ]
        );
    }


    public function sendYahrzeits()
    {
        $members = Request::get('member');
        usort($members, function ($a, $b) {
            $aDate = $a['father_next_english_date']['date'] ?? $a['mother_next_english_date']['date'] ?? null;
            $bDate = $b['father_next_english_date']['date'] ?? $b['mother_next_english_date']['date'] ?? null;

            if ($aDate === $bDate) {
                return 0;
            }
            return ($aDate < $bDate) ? -1 : 1;
        });

        Mail::to('frenchiejnr@gmail.com')->send(new Yahrzeits($members));
        return (new Yahrzeits($members))->render();
    }
}
