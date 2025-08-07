<?php

namespace App\Providers;

use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Http\Middleware\ValidatePostSize;
use Illuminate\Support\ServiceProvider;

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
        $this->app->singleton(\Illuminate\Contracts\Http\Kernel::class, function ($app) {
            return new class($app) extends \Illuminate\Foundation\Http\Kernel {
                protected $middleware = [
                    TrimStrings::class,
                    ValidatePostSize::class,
                ];
            };
        });

    }
}
