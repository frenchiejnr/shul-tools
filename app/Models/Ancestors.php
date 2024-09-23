<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ancestors extends Model
{
    use HasFactory;

    public function ShulMembers()
    {
        return $this->belongsTo(ShulMembers::class);
    }
}
