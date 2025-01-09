<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantsController extends Controller
{
    public function index()
    {
        $tenants = Tenant::all();
        dd($tenants);
    }
}
