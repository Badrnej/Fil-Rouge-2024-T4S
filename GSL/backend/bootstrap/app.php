<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Configure the Laravel application
return Application::configure(basePath: dirname(__DIR__))

    // Load route files
    ->withRouting(
        web: __DIR__.'/../routes/web.php',       // Route pour les pages web
        api: __DIR__.'/../routes/api.php',       // Route pour l'API (changement du nom de l'argument)
        commands: __DIR__.'/../routes/console.php',  // Commandes de console
        health: '/up'    // Vérification de santé de l'application
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
