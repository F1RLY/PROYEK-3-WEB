<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Middleware global (Dijalankan di setiap request)
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        // HAPUS PreventBackHistory dari sini agar tidak bentrok secara global
    ];
    
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Middleware yang bisa dipanggil di Routes (web.php)
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'role' => \App\Http\Middleware\Role::class,
        // Cukup daftarkan di sini saja agar bisa dipanggil dengan nama 'preventBackHistory'
        'preventBackHistory' => \App\Http\Middleware\PreventBackHistory::class,
    ];

    // Di Laravel versi lama, ini biasanya tidak diperlukan jika sudah ada di $routeMiddleware
    protected $middlewareAliases = [
        'role' => \App\Http\Middleware\Role::class,
        'preventBackHistory' => \App\Http\Middleware\PreventBackHistory::class,
    ];
}