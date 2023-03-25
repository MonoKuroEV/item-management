<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

        //
        //管理ユーザー
        Gate::define('admin', function(User $user){
            return ($user->role === 1 || $user->role === 2);
        });

        //管理ユーザー
        Gate::define('master', function(User $user){
            return ($user->role === 2);
        });
    }
}
