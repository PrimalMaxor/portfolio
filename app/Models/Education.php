<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'school',
        'degree',
        'description',
        'image',
        'url',
        'start_date',
        'end_date',
    ];
}
