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

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
