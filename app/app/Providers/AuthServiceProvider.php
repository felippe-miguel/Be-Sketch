<?php

namespace App\Providers;

use App\Models\Board;
use App\Models\Column;
use App\Models\Task;
use App\Policies\BoardPolicy;
use App\Policies\CardPolicy;
use App\Policies\ColumnPolicy;
use App\Policies\TaskPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Board::class => BoardPolicy::class,
        Column::class => ColumnPolicy::class,
        Card::class => CardPolicy::class,
        Task::class => TaskPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('board-show', [BoardPolicy::class, 'show']);
        Gate::define('board-update', [BoardPolicy::class, 'update']);
        Gate::define('board-destroy', [BoardPolicy::class, 'destroy']);

        Gate::define('column-show', [ColumnPolicy::class, 'show']);
        Gate::define('column-update', [ColumnPolicy::class, 'update']);
        Gate::define('column-destroy', [ColumnPolicy::class, 'destroy']);

        Gate::define('card-show', [CardPolicy::class, 'show']);
        Gate::define('card-update', [CardPolicy::class, 'update']);
        Gate::define('card-destroy', [CardPolicy::class, 'destroy']);

        Gate::define('task-show', [TaskPolicy::class, 'show']);
        Gate::define('task-update', [TaskPolicy::class, 'update']);
        Gate::define('task-destroy', [TaskPolicy::class, 'destroy']);
    }
}
