<?php

namespace App\Providers;

use App\Models\Board;
use App\Policies\BoardPolicy;
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
        Board::class => BoardPolicy::class
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
    }
}
