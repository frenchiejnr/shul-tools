<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'domain',
    ];

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
