<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ancestors extends Model
{
    use HasFactory;

    protected $fillable = [
        'fathers_hebrew_name',
        'mothers_hebrew_name',
        'paternal_grandfather_hebrew_name',
        'paternal_grandmother_hebrew_name',
        'maternal_grandfather_hebrew_name',
        'maternal_grandmother_hebrew_name',
    ];

    public function ShulMembers()
    {
        return $this->belongsTo(ShulMembers::class);
    }
}
