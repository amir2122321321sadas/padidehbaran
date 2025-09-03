<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Term extends Model
{
    use softDeletes;
    protected $table = 'terms';
    protected $guarded = ['id' , 'created_at' , 'updated_at'];

    public static function getActiveTerm()
    {
        return self::
            first();
    }
}
