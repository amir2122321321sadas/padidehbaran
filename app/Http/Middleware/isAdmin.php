<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            // بررسی نقش کاربر
            if (!Auth::user() || !Auth::user()->hasRole('admin')) {
                abort(404 , 'صفحه مورد نظر وجود ندارد'); // دسترسی غیرمجاز
            }
            return $next($request);
    }
}
