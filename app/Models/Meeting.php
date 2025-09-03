<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use softDeletes;
    protected $table = 'meetings';
    protected $guarded = ['id' , 'created_at' , 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

public static function getMeetingsForCurrentUser()
{
    $userId = auth()->id();
    // فرض بر این است که فیلد user_id به صورت رشته json ذخیره شده است مانند: ["1","2"]
    return self::whereJsonContains('user_id', (string)$userId)->where('status' , 1)->get();
}
}
