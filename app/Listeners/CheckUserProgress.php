<?php

namespace App\Listeners;

use App\Events\UserProgressChecked;
use App\Models\Alert;
use App\Models\Level;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class CheckUserProgress
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserProgressChecked $event): void
    {
        $user = $event->user;

        $levelUser = auth()->user()->level_id;
        $nextLevelUser = $levelUser += 1;
        //تغییر دهنده سطح

        $level = Level::where('order_level' , $nextLevelUser)->first();

        if ($level) {
            $levelChanger = Level::where('order_level' , $nextLevelUser)->first()->changer;

            //تعداد کل بیمه نامه های فعال کاربر و تعداد کل زیر مجموعه کاربر
            $countInsurancePoliciesUser = Auth::user()->insurancePolicies()->where('status' , 1)->count();
            $subCountAll = auth()->user()->allSubordinatesCount();
            $directSubUsers = auth()->user()->directSubordinates->count();



            if ($subCountAll >= $levelChanger->subtotal_number && $countInsurancePoliciesUser >= $levelChanger->insurance_policies_number) {

                $orderLevel = $level->order_level + 0;

                $result =  $user->update([
                    'level_id' => $orderLevel,
                ]);

                $fullName = $user->userInformation->first_name . ' ' . $user->userInformation->last_name;

                $notification = Alert::create([
                    'user_id' => $user->id,
                    'title' => 'سطح شما تغییر کرد🎉🎉🎉' . 'سطح جدید شما:' . $level->name,
                    'content' => $fullName . ' ' . 'عزیز سطح شما تغییر کرد و به دوره های جدید دسترسی خواهید داشت تبریک میگم!',
                    'status' => 1,
                    'level_id' => $orderLevel,
                ]);

            }

        }

    }
}
