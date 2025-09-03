<?php

use App\Http\Middleware\canWatchCourse;
use App\Http\Middleware\changerLevel;
use App\Http\Middleware\checkerAndChangerActiveProfileUser;
use App\Models\InsurancePolicy;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'authCheck' => \App\Http\Middleware\authCheck::class,
            'changerLevel' => ChangerLevel::class,
            'canWatchCourse' => CanWatchCourse::class,
            'checkerInsurancePolicyAndExcel' => checkerAndChangerActiveProfileUser::class,
            'check.insurance' => \App\Http\Middleware\CheckUserLastInsurance::class,
            // Add more aliases as needed
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
