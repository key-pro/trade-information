<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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
        Gate::define('MeigaraCategory_create',function(User $user){
            return $user -> role === User::ROLE_ADMIN ? true : false;
        });
        Gate::define('MeigaraCategory_edit',function(User $user){
            return $user -> role === User::ROLE_ADMIN ? true : false;
        });
        Gate::define('MeigaraCategory_delete',function(User $user){
            return $user -> role === User::ROLE_ADMIN ? true : false;
        });

        //
        Gate::define('Meigara_create',function(User $user){
            return $user -> role === User::ROLE_ADMIN ? true : false;
        });

        Gate::define('Meigara_edit',function(User $user){
            return $user -> role === User::ROLE_ADMIN ? true : false;
        });

        Gate::define('Meigara_delete',function(User $user){
            return $user -> role === User::ROLE_ADMIN ? true : false;
        });
    }
}
