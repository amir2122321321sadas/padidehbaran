<?php

namespace App\Filament\Resources\UserNationalityDataResource\Widgets;

use App\Models\UserNationalityData;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserNationalityDataStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRecords = UserNationalityData::count();
        $usersWithoutData = User::whereDoesntHave('userNationalityData')->count();

        return [
            Stat::make('تعداد کل اطلاعات هویتی ثبت شده', $totalRecords)
                ->icon('heroicon-o-identification')
                ->description('تمام اطلاعات هویتی ثبت شده')
                ->color('primary')
                ->chart([0, $totalRecords])
                ->extraAttributes(['class' => 'text-lg font-bold']),

            Stat::make('کاربران بدون اطلاعات هویتی', $usersWithoutData)
                ->icon('heroicon-o-user')
                ->description('کاربرانی که اطلاعات هویتی ثبت نکرده‌اند')
                ->color('danger')
                ->chart([0, $usersWithoutData])
                ->extraAttributes(['class' => 'text-lg font-bold']),
        ];
    }
}