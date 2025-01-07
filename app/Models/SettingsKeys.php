<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingsKeys extends Model
{
    protected $fillable = [
        'key',
        'label',
    ];
}
