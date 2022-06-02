<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'is_periodic',
        'duration',
        'starts_at',
        'hash',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
    ];
}
