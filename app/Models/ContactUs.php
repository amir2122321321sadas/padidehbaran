<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use softDeletes;
    protected $table = 'contact_us';
    protected $guarded = ['id' , 'created_at' , 'updated_at'];

}
