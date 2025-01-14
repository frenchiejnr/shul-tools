<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\SettingsKeys;
use App\Models\Tenant;

class SuperSettingsController extends Controller
{
    public function index()
    {
        $settingsKeys = SettingsKeys::all();
        $tenants = Tenant::all();
        return Inertia::render('SuperSettings/Index', [
            'settingsKeys' => $settingsKeys,
            'tenants' => $tenants
        ]);
    }
}
