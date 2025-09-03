<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use softDeletes;
    protected $table = 'banners';
    protected $guarded = ['created_at', 'updated_at'];

    public static function getActiveMainBanners()
    {
        return self::where('status', 1)
            ->where('location', 0)
            ->get();
    }
    public static function getActiveMiddleMainBanners()
    {
        return self::where('status', 1)
            ->where('location', 1)
            ->get();
    }

    public static function getActiveTopAllPagesBanners()
    {
        return self::where('status', 1)
            ->where('location', 2)
            ->get();
    }

    public static function getActiveUserDashboardBanners()
    {
        return self::where('status', 1)
            ->where('location', 3)
            ->get();
    }

    public static function getActiveOtherBanners()
    {
        return self::where('status', 1)
            ->where('location', 4)
            ->get();
    }

    public const LOCATION_OPTIONS = [
        0 => 'بنر صفحه اصلی',
        1 => 'بنر وسط صفحه اصلی',
        2 => 'بنر بالای تمام صفحات',
        3 => 'بنر داخل داشبورد کاربران',
        4 => 'بقیه موارد'
    ];
}
