<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        // $tenantId = $request->user()->tenant_id;
        $tenantId = 1;
        $settings = Setting::where('tenant_id', $tenantId)->get();
        return Inertia::render('Settings/Index', ['settings' => $settings]);
    }
}
