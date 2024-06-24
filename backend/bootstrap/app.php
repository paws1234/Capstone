<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
       
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'cors' => \App\Http\Middleware\Cors::class,
        ]);
       
        
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'Admin' => \App\Http\Middleware\Admin::class,
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'Student' => \App\Http\Middleware\StudentMiddleware::class,
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'Teacher' => \App\Http\Middleware\TeacherMiddleware::class,
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->statefulApi();
       
        
    })
  
   
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
