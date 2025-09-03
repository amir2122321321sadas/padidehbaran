<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use softDeletes;
    protected $table = 'settings';
    protected $guarded = ['id' , 'created_at' , 'updated_at'];
}
