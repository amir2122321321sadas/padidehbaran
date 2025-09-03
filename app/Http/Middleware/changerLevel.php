<?php

namespace App\Http\Middleware;

use App\Events\UserProgressChecked;
use App\Models\Alert;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class changerLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        event(new UserProgressChecked($user));



        return $next($request);
    }
}
