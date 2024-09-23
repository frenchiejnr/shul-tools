<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShulMembers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hebrew_name',
        'gender',
    ];
}
