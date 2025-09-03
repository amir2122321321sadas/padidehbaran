<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    protected $guarded = ['id' , 'created_at' , 'updated_at' , 'deleted_at'];

    protected $table = 'menus';


    // وضعیت‌های مجاز برای منو
    public const STATUS_OPTIONS = [
        'active' => 'فعال',
        'inactive' => 'غیرفعال',
    ];

    public static function getActiveMenus()
    {
        return self::where('status', 'active')
            ->get();
    }
    public const PERMISSION_OPTIONS = [
        'only_logged_in' => 'همه کاربران لاگین شده',
        'only_admin' => 'فقط ادمین',
        'only_user' => 'فقط کاربران عادی لاگین شده',
        'only_guest' => 'فقط کاربران لاگین نشده',
    ];



    public function font(){
        return $this->belongsTo(Font::class);
    }
    // رابطه با پدر (منوی والد)
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    // رابطه با فرزندان (زیرمنوها)
    public function children()
    {
        return $this->hasMany(Menu::class, 'menu_id');
    }
}
