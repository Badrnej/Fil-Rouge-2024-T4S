<?php

namespace App\Http;

class Kernel {
    protected $routeMiddleware = [
        // ...
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.jwt' => \Tymon\JWTAuth\Http\Middleware\Authenticate::class,
    ];
}
