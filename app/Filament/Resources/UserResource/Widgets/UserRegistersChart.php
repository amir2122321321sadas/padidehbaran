<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\User;
use Illuminate\Support\Carbon;

class UserRegistersChart extends ChartWidget
{
    // عنوان فارسی برای نمودار
    protected static ?string $heading = 'آمار ثبت‌نام کاربران در سال جاری';
    protected static ?string $pollingInterval = '10s';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '300px';
    /**
     * نمایش نمودار در تمام عرض صفحه
     */
    public static function canView(): bool
    {
        return true;
    }

    /**
     * دریافت داده‌های نمودار ثبت‌نام کاربران به تفکیک ماه و نمایش جزئیات بیشتر
     */
    protected function getData(): array
    {
        $currentYear = now()->year;

        // Get user registrations grouped by month for the current year
        $usersPerMonth = User::query()
            ->whereYear('created_at', $currentYear)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->all();

        // Prepare data for all 12 months
        $data = [];
        $labels = [];
        for ($month = 1; $month <= 12; $month++) {
            $labels[] = \DateTime::createFromFormat('!m', $month)->format('F');
            $data[] = $usersPerMonth[$month] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'تعداد کاربران ثبت نامی',
                    'data' => $data,
                    'backgroundColor' => 'primary',
                ],
            ],
            'labels' => $labels,
        ];
    }

    /**
     * نوع نمودار (می‌توانید 'bar' یا 'line' یا ترکیبی استفاده کنید)
     */
    protected function getType(): string
    {
        return 'line';
    }
}
