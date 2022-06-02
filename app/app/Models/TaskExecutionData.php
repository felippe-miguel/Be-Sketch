<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskExecutionData extends Model
{
    use SoftDeletes;

    protected $table = 'task_execution_data';

    protected $fillable = [
        'task_id',
        'is_done',
        'datetime',
    ];

    protected $casts = [
        'datetime' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
