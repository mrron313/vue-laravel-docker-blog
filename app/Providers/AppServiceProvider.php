<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Laravel\Passport\Passport::withoutCookieSerialization();

        Blade::directive('upper', function ($expression) {
            return "<?php echo strtoupper($expression); ?>";
        });
    }
}
