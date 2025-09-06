<?php

namespace Modules\Frontend\Livewire\Client\Pages\Profile;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;
use Morilog\Jalali\Jalalian;

class MainProfilePage extends Component
{
    public $courses;


    public $monthlyIncome;
    public $incomes;

    public function mount()
    {
        $user = auth()->user();
        $userId = auth()->id();

        $allIncomes = DB::table('income_users')
            ->where('user_id', $userId)
            ->whereYear('created_at', now()->year) // فیلتر اولیه بر اساس میلادی
            ->get(['income', 'created_at']);

        // مقداردهی اولیه ۱۲ ماه شمسی (فروردین تا اسفند)
        $monthlyIncomeMap = array_fill(1, 12, 0);

        foreach ($allIncomes as $income) {
            $jalali = Jalalian::fromDateTime($income->created_at);
            $month = $jalali->getMonth(); // مثلاً 5 => مرداد
            $monthlyIncomeMap[$month] += $income->income;
        }

        // تبدیل به آرایه ایندکسی برای نمودار
        $this->monthlyIncome = [];
        for ($i = 1; $i <= 12; $i++) {
            $this->monthlyIncome[] = (int) ($monthlyIncomeMap[$i] ?? 0);
        }

        // سایر داده‌ها
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
