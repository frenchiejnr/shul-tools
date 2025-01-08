<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\SettingsKeys;

class SuperSettingsController extends Controller
{
    public function index()
    {
        $settingsKeys = SettingsKeys::all();
        return Inertia::render('SuperSettings/Index', [
            'settingsKeys' => $settingsKeys
        ]);
    }
}
