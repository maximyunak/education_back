<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = [
        'id',
        'test_id',
        'text',
        'type',
        'points',
    ];
}
