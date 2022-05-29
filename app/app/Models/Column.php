<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    public function board()
    {
        $this->belongsTo(Board::class);
    }

    public function cards()
    {
        $this->hasMany(Card::class);
    }
}
