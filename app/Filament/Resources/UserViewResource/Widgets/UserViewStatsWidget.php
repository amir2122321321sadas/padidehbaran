<?php

namespace App\Filament\Resources\UserViewResource\Widgets;

use App\Models\UserView;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserViewStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalViews = UserView::count();
        $totalMinutes = UserView::sum('total_time');
        $averageMinutes = $totalViews > 0 ? round($totalMinutes / $totalViews, 2) : 0;
        $averageHours = $averageMinutes > 0 ? round($averageMinutes / 60, 2) : 0;

        return [
            Stat::make('تعداد کل بازدیدها', $totalViews)
                ->icon('heroicon-o-eye')
                ->description('تمام بازدیدهای ثبت شده')
                ->color('primary')
                ->chart([0, $totalViews])
                ->extraAttributes(['class' => 'text-lg font-bold']),

            Stat::make('میانگین مشاهده (دقیقه)', $averageMinutes)
                ->icon('heroicon-o-clock')
                ->description('میانگین مدت مشاهده به دقیقه')
                ->color('success')
                ->chart([0, $averageMinutes])
                ->extraAttributes(['class' => 'text-lg font-bold']),

            Stat::make('میانگین مشاهده (ساعت)', $averageHours)
                ->icon('heroicon-o-clock')
                ->description('میانگین مدت مشاهده به ساعت')
                ->color('warning')
                ->chart([0, $averageHours])
                ->extraAttributes(['class' => 'text-lg font-bold']),
        ];
    }
}