<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        $middleware->alias([
            'localize' => App\Http\Middleware\Localize::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->reportable(function (Throwable $e) {
            if (app()->environment('production') || !config('app.debug')) {
                try {
                    $settings = \App\Models\SiteSetting::first();
                    $adminEmail = $settings->notification_email ?? config('mail.from.address');
                    
                    if ($adminEmail) {
                        \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\ErrorNotification($e));
                    }
                } catch (\Throwable $m) {
                    // Evitar bucle infinito si falla el envío de correo
                    \Illuminate\Support\Facades\Log::error('Error sending exception notification: ' . $m->getMessage());
                }
            }
        });
    })->create();
