<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\SettingsKeys;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $tenantId = $request->user()->tenant_id;
        $settings = Setting::where('tenant_id', $tenantId)->get();
        $settingsKeys = SettingsKeys::all();
        return Inertia::render('Settings/Index', [
            'settings' => $settings,
            'settingsKeys' => $settingsKeys
        ]);
    }
}
