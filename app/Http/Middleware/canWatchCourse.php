<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class canWatchCourse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $courseSlug = $request->route('course')->slug;
       $user = auth()->user();
       $course = $user->activeCoursesFromLevel()->where('slug', $courseSlug)->first();
       if ($course) {
           return $next($request);
       }else{
           abort(403 , '!در این سطح شما دسترسی به این دوره را ندارید');
       }

    }
}
