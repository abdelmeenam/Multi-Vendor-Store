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
         'App\Models\Product' => 'App\Policies\ProductPolicy',
            'App\Models\Role' => 'App\Policies\RolePolicy',
    ];


    public function register()
    {
        parent::register();

        //Add to service conatiner
        $this->app->bind('abilities', function () {
            return include base_path('data/abilities.php');
        });

        //$this->app->instance('abilities', include base_path('data/abilities.php'));
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //if user is super admin return true and don't check any other policy or ability
//        Gate::before(function ($user , $ability) {
//            if ($user->super_admin) {
//                return true;
//            }
//        });


        //Register abilities as gates for policies with authenticated user
        foreach ($this->app->make('abilities') as $code => $label) {

            Gate::define($code, function ($user) use ($code) {
                return $user->hasAbility($code);
            });
    }
    }
}
