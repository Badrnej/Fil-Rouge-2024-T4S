<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Configure the Laravel application
return Application::configure(basePath: dirname(__DIR__))

    // Load route files
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        web: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up'
    )

    // Register middleware configuration
    ->withMiddleware(function (Middleware $middleware) {
        // Exclude specific routes from CSRF protection
        $middleware->validateCsrfTokens(
            except: ['api/*', 'stripe/*', 'login', 'register',]
        );

        // Add any additional middleware you need
        // e.g., $middleware->add(SomeMiddleware::class);
    })

    // Handle exceptions configuration
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle exceptions here if needed
    })

    // Create the application
    ->create();
