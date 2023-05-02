<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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

        //Gates
        Gate::define('categories.view', function ($user){
            return true;
        });

        Gate::define('categories.create', function ($user){
            return false;
        });

        Gate::define('categories.update', function ($user){
            return false;
        });

        Gate::define('categories.delete', function ($user){
            return false;
        });
    }
}
