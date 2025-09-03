<?php

namespace App\Http\Middleware;

use App\Models\CheckerExcel;
use App\Models\InsurancePolicy;
use App\Models\PageContactUs;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkerAndChangerActiveProfileUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user) {
            // گرفتن شماره بیمه‌نامه‌های فعال کاربر
            $userPolicyNumbers = $user->insurancePolicies()
                ->where('status', 1)
                ->pluck('insurance_policies_number');

            if ($userPolicyNumbers->isNotEmpty()) {

                // پیدا کردن بیمه‌نامه‌هایی که در checker_excels وجود دارند
                $matchingPolicies = CheckerExcel::whereIn('policy_number', $userPolicyNumbers)
                    ->pluck('policy_number');

                if ($matchingPolicies->isNotEmpty()) {
                    // آپدیت رکوردهای مطابقت یافته
                    InsurancePolicy::where('user_id', $user->id)
                        ->whereIn('insurance_policies_number', $matchingPolicies)
                        ->update(['un_paid' => 'true']);

                    // آپدیت رکوردهای غیرمطابقت یافته
                    InsurancePolicy::where('user_id', $user->id)
                        ->whereNotIn('insurance_policies_number', $matchingPolicies)
                        ->update(['un_paid' => 'false']);

                    // کاربر غیرفعال و دارای بیمه نامه پرداخت نشده
                    $user->update(['is_active' => 2]);

                } else {
                    // هیچ بیمه‌نامه‌ای مطابقت ندارد
                    InsurancePolicy::where('user_id', $user->id)
                        ->update(['un_paid' => 'false']);

                    $user->update(['is_active' => 1]);
                }

            } else {
                // کاربر بیمه‌نامه فعالی ندارد
                $user->update(['is_active' => 0]);
            }
        }

        return $next($request);
    }
}
