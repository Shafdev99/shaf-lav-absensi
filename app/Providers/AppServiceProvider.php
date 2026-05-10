<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Walkel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /// Get the AliasLoader instance
        $loader = AliasLoader::getInstance();

        // Add your aliases
        $loader->alias('Excel', Excel::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // if (env('APP_ENV') !== 'local') {
        // }
        // URL::forceScheme('https');

        // Paginasi menggunakan style bootstrap
        Paginator::useBootstrapFive();

        // Gate untuk admin
        Gate::define('admin', function (User $user) {
            return  $user->role == 'admin';
        });

        // Gate untuk staff
        Gate::define('staff_dan_admin', function (User $user) {
            return  $user->role == 'staff' || $user->role == 'admin';
        });

        // Gate untuk wali_kelas
        Gate::define('wali_kelas', function (User $user) {
            //    $iniWalkel = 
            return Walkel::cekWalkel()
                ->where('users.id', $user->id)
                ->first()?->guru_id;;
        });
    }
}
