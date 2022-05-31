<?php

namespace App\Providers;

use App\Models\Board;
use App\Models\Column;
use App\Policies\BoardPolicy;
use App\Policies\ColumnPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Board::class => BoardPolicy::class,
        Column::class => ColumnPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('board-show', [BoardPolicy::class, 'show']);
        Gate::define('board-update', [BoardPolicy::class, 'update']);
        Gate::define('board-destroy', [BoardPolicy::class, 'destroy']);

        Gate::define('column-show', [ColumnPolicy::class, 'show']);
        Gate::define('column-update', [ColumnPolicy::class, 'update']);
        Gate::define('column-destroy', [ColumnPolicy::class, 'destroy']);
    }
}
