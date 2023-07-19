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

        // Gate untuk menampilkan menu khusus admin
        Gate::define('admin_area', function ($user) {

            if (auth()->user()->is_admin == 1) {
                return true;
            }

            return false;

        });

        // Gate untuk menampilkan menu khusus User
        Gate::define('user_area', function ($user) {

            if (auth()->user()->is_admin == 0 && auth()->user()->email_verified_at != NULL) {
                return true;
            }

            return false;

        });

        // Gate untuk visitor / non user
        Gate::define('visitor_area', function ($user = null) {
            return $user == null;
        });

        // Gate untuk user belum verifikasi
        Gate::define('user_non_verif_area', function ($user) {

            if (auth()->user()->is_admin == 0 && auth()->user()->email_verified_at == NULL) {
                return true;
            }

            return false;

        });
    }
}
