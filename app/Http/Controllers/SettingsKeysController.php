<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use App\Models\SettingsKeys;

class SettingsKeysController extends Controller
{
    public function edit(int $settingId)
    {
        $settingsKey = SettingsKeys::findOrFail($settingId);
        $data = Request::validate([
            'key' => ['required'],
            'label' => ['required'],
        ]);
        $settingsKey->update($data);
    }
    }
