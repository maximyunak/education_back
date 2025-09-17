<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'test_id',
        'text',
        'type',
        'points',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
