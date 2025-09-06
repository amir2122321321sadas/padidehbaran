<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use SoftDeletes;

    protected $table = 'income_users';


    protected $guarded = ['id'  , 'updated_at'];
    public function user(){
        return $this->belongsTo(User::class);
    }

}
