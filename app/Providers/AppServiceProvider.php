<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Schema::defaultStringLength(191);
        
        // Blade::directive('hello', function ($value) {
        //     return "Hello" . $value;
        // });

        Blade::directive('ifExpenses', function ($expression) {
            return "<?php if($expression) { ?>";
        });

        Blade::directive('elseExpenses', function () {
            return "<?php } else { ?>";
        });

        Blade::directive('endExpenses', function () {
            return "<?php } ?>";
        });
    }
}
