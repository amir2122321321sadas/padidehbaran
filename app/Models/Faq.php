<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use softDeletes;
    protected $table = 'faq';
    protected $guarded = ['id' , 'created_at' , 'updated_at'];

    public static function getActiveFaqs()
    {
        return self::where('status', 1)
            ->orderBy('order', 'asc')
            ->get();
    }
}
