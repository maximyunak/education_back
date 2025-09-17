<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = [
        'test_id',
        'text',
        'type',
        'points',
    ];

    protected function answers()
    {
        return $this->hasMany(Answers::class);
    }
}
