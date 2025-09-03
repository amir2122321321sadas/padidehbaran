<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChangerItem extends Model
{
    use softDeletes;
    protected $table = 'changer_items';

    public static function getActiveChangerItems()
    {
        return self::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();
    }

    protected $guarded = ['id' , 'created_at' , 'updated_at'];
}
