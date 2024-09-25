<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShulMembers extends Model
{
    use HasFactory;

    protected $fillable = [
        'forenames',
        'surname',
        'hebrew_name',
        'gender',
        'paternal_status',
    ];

    public function ancestors()
    {
        return $this->hasOne(Ancestors::class, 'id', 'ancestors_id');
    }
}
