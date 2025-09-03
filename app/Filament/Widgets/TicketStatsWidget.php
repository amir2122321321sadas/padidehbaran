<?php

namespace App\Filament\Widgets;

use App\Models\Ticket;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TicketStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('کل تیکت‌ها', Ticket::count())
                ->description('تعداد کل تیکت‌های ثبت شده')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('primary'),

            Stat::make('تیکت‌های باز', Ticket::where('status', 'pending')->count())
                ->description('تیکت‌هایی که منتظر پاسخ پشتیبان هستند')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('در حال بررسی', Ticket::where('status', 'hasAnswer')->count())
                ->description('تیکت‌هایی که در حال بررسی هستند')
                ->descriptionIcon('heroicon-m-arrow-path-rounded-square')
                ->color('info'),

            Stat::make('بسته', Ticket::where('status', 'closed')->count())
                ->description('تیکت‌هایی که بسته شده‌اند')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),

            Stat::make('اولویت بالا', Ticket::whereIn('priority', ['high', 'urgent'])->count())
                ->description('تیکت‌های با اولویت بالا')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
