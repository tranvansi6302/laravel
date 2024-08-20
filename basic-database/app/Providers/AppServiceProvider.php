<?php

namespace App\Providers;

use App\View\Components\Alert;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Tự định nghĩa Blade directive
        // Blade::directive('datetime', function ($expression) {
        //     $expression = trim($expression, '\'');
        //     $expression = trim($expression, '""');
        //     $dateObject = date_create($expression);
        //     if (!empty($dateObject)) {
        //         $format = $dateObject->format('d/m/Y H:i:s');
        //         return $format;
        //     }
        //     return false;
        // });

        // Blade directive Rẻ nhánh
        // Blade::if('env', function ($value) {
        //     if (config('app.env') === $value) {
        //         return true;
        //     }
        //     return false;
        // });

        // Component

        Blade::component('alert-message', Alert::class);
    }
}
