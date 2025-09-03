<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alert extends Model
{

    protected $table = 'alerts';
    protected $fillable = ['status' , 'title' , 'content' , 'user_id' , 'level_id'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public static function getActiveAlerts()
    {
        return self::where('status', 1)
            ->get();
    }
}
