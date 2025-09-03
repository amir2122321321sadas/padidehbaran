<?php

namespace App\Filament\Resources\InsurancePolicyResource\Widgets;

use App\Models\InsurancePolicy;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InsurancePolicyWidget extends BaseWidget
{

    public const STATUS_OPTIONS = [
        0 => 'غیرفعال',
        1 => 'فعال',
        2 => 'منتظر بررسی',
        3 => 'رد شده(منتظر ویرایش)'
    ];

    public const UN_PAID_OPTIONS = [
        'true' => 'پرداخت شده',
        'false' => 'پرداخت نشده!'
    ];

    protected function getStats(): array
    {
        $todayCount = InsurancePolicy::whereDate('created_at', now())->count();

        // Count for each status
        $statusCounts = [];
        foreach (self::STATUS_OPTIONS as $statusKey => $statusLabel) {
            $statusCounts[$statusKey] = InsurancePolicy::where('status', $statusKey)->count();
        }

        return [
            Stat::make('تعداد کل بیمه نامه ها', InsurancePolicy::count())
                ->icon('heroicon-o-users')
                ->description('بیمه نامه های ثبت شده')
                ->color('primary')
                // چارت هفتگی: تعداد بیمه‌نامه‌های ثبت شده در ۷ روز گذشته (از ۶ روز پیش تا امروز)
                ->chart(
                    collect(range(6, 0))
                        ->map(function ($daysAgo) {
                            return InsurancePolicy::whereDate('created_at', now()->subDays($daysAgo)->toDateString())->count();
                        })
                        ->toArray()
                )
                ->extraAttributes(['class' => 'text-lg font-bold']),

            Stat::make('بیمه نامه های امروز', $todayCount)
                ->icon('heroicon-o-user-plus')
                ->description('بیمه نامه های جدید امروز')
                ->color('success')
                ->chart([0, $todayCount])
                ->extraAttributes(['class' => 'text-lg font-bold']),

            Stat::make('بیمه نامه های غیرفعال', $statusCounts[0] ?? 0)
                ->icon('heroicon-o-x-circle')
                ->description('تعداد بیمه نامه های غیرفعال')
                ->color('gray')
                ->chart([0, $statusCounts[0] ?? 0])
                ->extraAttributes(['class' => 'text-lg font-bold']),

            Stat::make('بیمه نامه های فعال', $statusCounts[1] ?? 0)
                ->icon('heroicon-o-check-circle')
                ->description('تعداد بیمه نامه های فعال')
                ->color('success')
                ->chart([0, $statusCounts[1] ?? 0])
                ->extraAttributes(['class' => 'text-lg font-bold']),

            Stat::make('بیمه نامه های منتظر بررسی', $statusCounts[2] ?? 0)
                ->icon('heroicon-o-clock')
                ->description('تعداد بیمه نامه های منتظر بررسی')
                ->color('warning')
                // چارت هفتگی: تعداد بیمه‌نامه‌های منتظر بررسی در ۷ روز گذشته (از ۶ روز پیش تا امروز)
                ->chart(
                    collect(range(6, 0))
                        ->map(function ($daysAgo) {
                            return \App\Models\InsurancePolicy::where('status', 2)
                                ->whereDate('created_at', now()->subDays($daysAgo)->toDateString())
                                ->count();
                        })
                        ->toArray()
                )
                ->extraAttributes(['class' => 'text-lg font-bold']),

            Stat::make('بیمه نامه های رد شده(منتظر ویرایش)', $statusCounts[3] ?? 0)
                ->icon('heroicon-o-exclamation-circle')
                ->description('تعداد بیمه نامه های رد شده (منتظر ویرایش)')
                ->color('danger')
                ->chart([0, $statusCounts[3] ?? 0])
                ->extraAttributes(['class' => 'text-lg font-bold']),

            Stat::make('بیمه نامه های پرداخت نشده', InsurancePolicy::where('un_paid', 'true')->count())
                ->icon('heroicon-o-exclamation-circle')
                ->description('تعداد بیمه نامه های پرداخت نشده')
                ->color('danger')
                ->chart([0,InsurancePolicy::where('un_paid', 'true')->count()])
                ->extraAttributes(['class' => 'text-lg font-bold']),

        ];
    }
}
