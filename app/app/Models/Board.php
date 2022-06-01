<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function columns()
    {
        return $this->hasMany(Column::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($board) {
            Card::whereHas('column', function (Builder $query) use ($board) {
                $query->where('board_id', $board->id);
            })->delete();

            $board->columns()->delete();
        });
    }
}
