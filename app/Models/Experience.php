<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company',
        'position',
        'description',
        'image',
        'url',
        'start_date',
        'end_date',
    ];
}
