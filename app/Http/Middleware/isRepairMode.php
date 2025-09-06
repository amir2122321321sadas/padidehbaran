<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isRepairMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $setting = Setting::first();
        $user = Auth::user();
        if ($setting->is_repair_mode){
            if ($user->hasRole('admin')){
                return $next($request);
            }else{
                abort(503 );
            }
        }else{
            return $next($request);
        }

    }
}
