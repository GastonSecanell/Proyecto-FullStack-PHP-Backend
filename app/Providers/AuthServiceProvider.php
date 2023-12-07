<?php

namespace App\Providers;

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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::before(function ($user, $ability, $arguments) {
            if ($user->rol === 1) { // isAdmin
                return true; // Permite cualquier acción
            }
        });


        Gate::define('isCarga', function ($user) {
            return $user->rol === 2;
        });

        Gate::define('isConsulta', function ($user) {
            return $user->rol === 3;
        });
    }
}
