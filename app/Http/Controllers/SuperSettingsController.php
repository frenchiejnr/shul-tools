<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SuperSettingsController extends Controller
{
    public function index()
    {
        return Inertia::render('SuperSettings/Index');
    }
}
