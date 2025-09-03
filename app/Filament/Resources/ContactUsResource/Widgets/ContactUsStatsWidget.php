<?php

namespace App\Filament\Resources\ContactUsResource\Widgets;

use App\Models\ContactUs;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContactUsStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalMessages = ContactUs::count();
        $readMessages = ContactUs::where('status', 1)->count();
        $unreadMessages = ContactUs::where('status', 0)->count();

        return [
            Stat::make('تعداد کل پیام‌ها', $totalMessages)
                ->icon('heroicon-o-chat-bubble-left-right')
                ->description('تمام پیام‌های دریافتی')
                ->color('primary')
                ->chart([0, $totalMessages])
                ->extraAttributes(['class' => 'text-lg font-bold']),

            Stat::make('پیام‌های خوانده شده', $readMessages)
                ->icon('heroicon-o-check-circle')
                ->description('پیام‌های بررسی شده')
                ->color('success')
                ->chart([0, $readMessages])
                ->extraAttributes(['class' => 'text-lg font-bold']),

            Stat::make('پیام‌های خوانده نشده', $unreadMessages)
                ->icon('heroicon-o-exclamation-circle')
                ->description('پیام‌های جدید')
                ->color('warning')
                ->chart([0, $unreadMessages])
                ->extraAttributes(['class' => 'text-lg font-bold']),
        ];
    }
} 