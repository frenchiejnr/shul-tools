<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Support\Facades\Request;

class TenantsController extends Controller
{


    public function edit(int $tenantId)
    {
        $tenant = Tenant::findOrFail($tenantId);
        $data = Request::validate([
            'name' => ['required', 'max:255'],
            'domain' => ['required', 'max:255'],
        ]);
        $tenant->update($data);
    }
}
