<?php

namespace Modules\Frontend\Livewire\Client\Pages\Profile;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

class MainProfilePage extends Component
{
    public $courses;


    public $monthlyIncome;
    public $incomes;

    public function mount()
    {
        $user = auth()->user();

        $userId = auth()->id(); // یا هر user_id که میخوای

        $this->incomes = DB::table('income_users')
            ->selectRaw('MONTH(created_at) as month, SUM(income) as total_income')
            ->where('user_id', $userId)
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total_income', 'month');

        $this->monthlyIncome = [];
        for ($i = 1; $i <= 12; $i++) {
            $this->monthlyIncome[] = (int) ($this->incomes[$i] ?? 0); // تبدیل به آرایه ایندکسی
        }


        //با استفاده از level_id level رو پیدا می کنه و بر اساس اون level خود کاربر course_id هایی که برای اون سطح از طریق پنل ادمین انتخاب شده اند برگردانده میشوند!
        $this->courses = $user->activeCoursesFromLevel();

    }


    #[Title('پروفایل کاربر')]
    public function render()
    {
        return view('frontend::livewire.client.pages.profile.main-profile-page', [
            'monthlyIncome' => array_values($this->monthlyIncome), // فقط اعداد
        ])
            ->extends('components.layouts.profile')
            ->section('content');
    }
}
