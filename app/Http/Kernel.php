<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // … middleware bawaan Laravel …
    ];

    protected $middlewareGroups = [
        'web' => [
            // … middleware group web bawaan …
        ],

        'api' => [
            // … middleware group api bawaan …
        ],
    ];

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        // ... lainnya ...
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // Daftarkan middleware admin di sini
        'admin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
    ];
}
