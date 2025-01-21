<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Models\SettingsKeys;

class SettingsKeysController extends Controller
{
    //store function
    public function store(Request $request)
    {
        $data = Request::validate([
            'key' => ['required'],
            'label' => ['required'],
        ]);
        SettingsKeys::create($data);
    }

    public function edit(int $settingId)
    {
        $settingsKey = SettingsKeys::findOrFail($settingId);
        $data = Request::validate([
            'key' => ['required'],
            'label' => ['required'],
        ]);
        $settingsKey->update($data);
    }

    public function delete(int $settingId)
    {
        $settingsKey = SettingsKeys::findOrFail($settingId);
        $settingsKey->delete();
    }
}
