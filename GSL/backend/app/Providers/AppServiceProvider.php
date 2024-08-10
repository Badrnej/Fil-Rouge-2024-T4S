<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
    public function boot()
    {
        // Disable CSRF for API routes
        if (request()->is("api/*")) {
            config(["session.driver" => "array"]);
            $this->app->instance("middleware.disable", true);
        }
    }
}
