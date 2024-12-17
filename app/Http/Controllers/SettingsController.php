<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


use App\Models\SettingsKeys;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $tenant_id = Auth::user()->tenant_id;
        $settings = Setting::where('tenant_id', $tenant_id)->get();
        $settingsKeys = SettingsKeys::whereNotIn('key', $settings->pluck('key'))->get();
        return Inertia::render('Settings/Index', [
            'settings' => $settings,
            'settingsKeys' => $settingsKeys,
            'can' => [
                'addSetting' => Auth::user()->isAdmin()
            ]
        ]);
    }

    public function store()
    {
        $tenantId = Auth::user()->tenant_id;
        $data = Request::validate([
            'key' => ['required'],
            'value' => ['required'],
        ]);
        $setting = new Setting($data);
        $setting->tenant_id = $tenantId;
        $setting->save();
        return redirect('/settings');
    }
}
