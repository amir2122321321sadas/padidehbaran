<?php

namespace App\Filament\Resources\CourseResource\Widgets;

use App\Models\Course;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CourseStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalCourses = Course::count();
        $activeCourses = Course::where('status', 1)->count();
        $inactiveCourses = Course::where('status', 0)->count();

        return [
            Stat::make('تعداد کل دوره‌ها', $totalCourses)
                ->icon('heroicon-o-academic-cap')
                ->description('تمام دوره‌های موجود')
                ->color('primary')
                ->chart([0, $totalCourses])
                ->extraAttributes(['class' => 'text-lg font-bold']),

            Stat::make('دوره‌های فعال', $activeCourses)
                ->icon('heroicon-o-check-circle')
                ->description('دوره‌های قابل دسترسی')
                ->color('success')
                ->chart([0, $activeCourses])
                ->extraAttributes(['class' => 'text-lg font-bold']),

            Stat::make('دوره‌های غیرفعال', $inactiveCourses)
                ->icon('heroicon-o-x-circle')
                ->description('دوره‌های غیرفعال')
                ->color('danger')
                ->chart([0, $inactiveCourses])
                ->extraAttributes(['class' => 'text-lg font-bold']),
        ];
    }
} 