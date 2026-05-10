<?php

use App\Http\Middleware\isAll;
use App\Http\Middleware\isGuru;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isLogin;
use App\Http\Middleware\isKepsek;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // Memberikan alias pada middleware yang kita buat
        $middleware->alias([
            'admin'  => isAdmin::class,
            'all'    => isAll::class,
            'guru'   => isGuru::class,
            'kepsek' => isKepsek::class,
            'login'  => isLogin::class,
        ]);

        // Mengalihkan ke halaman "/" jika user tidak mempunyai akses pada halaman tersebut
        $middleware->redirectGuestsTo('/');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
