<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckUserLastInsurance
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user) {
            // فرض می‌کنیم رابطه user -> insurances تعریف شده
            $lastInsurance = $user->insurancePolicies()->latest('created_at')->first();

            if ($lastInsurance) {
                $diffMonths = Carbon::parse($lastInsurance->created_at)->diffInMonths(now());

                if ($diffMonths >= 3 && !$user->isBanned()) {
                    // کاربر رو ban کن
                    $user->ban([
                        'comment' => 'کاربر گرامی پروفایل شما به دلیل عدم فعالیت غیرفعال شده است.',
                    ]);
                    Auth::logout();
                    return redirect('/');
                }else{
                    $user->unban();
                }
            }
        }

        // اگر کاربر ban شده بود، برگردونیمش به صفحه‌ی خاص
        if ($user && $user->isBanned()) {
            abort(403 , 'کاربر گرامی پروفایل شما به دلیل عدم فعالیت غیرفعال شده است ، لطفا با پشتیبانی در تماس باشید.');
        }

        return $next($request);
    }
}
