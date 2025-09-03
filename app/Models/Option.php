<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'options';

    protected $guarded = ['id' , 'created_at' , 'updated_at'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

}
