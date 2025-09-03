<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UsersCountWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $todayCount = User::whereDate('created_at', now())->count();
        return [
            Stat::make('تعداد کل کاربران', User::count())
                ->icon('heroicon-o-users')
                ->description('کاربران ثبت‌نام شده')
                ->color('primary')
                ->chart([User::count(), User::whereDate('created_at', now())->count()])
                ->extraAttributes(['class' => 'text-lg font-bold']),


            Stat::make('ثبت‌نامی‌های امروز', $todayCount)
                ->icon('heroicon-o-user-plus')
                ->description('کاربران جدید امروز')
                ->color('success')
                ->chart([0, $todayCount])
                ->extraAttributes(['class' => 'text-lg font-bold']),


            Stat::make('کاربران مسدود شده', User::whereNotNull('banned_at')->count())
                ->icon('heroicon-o-user-minus')
                ->description('تعداد کاربران مسدود شده')
                ->color('danger')
                ->chart([0, User::whereNotNull('banned_at')->count()])
                ->extraAttributes(['class' => 'text-lg font-bold']),

        ];
    }
}
