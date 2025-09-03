<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PageContactUs extends Model
{
    use softDeletes;
    protected $table = 'page_contact_us';
    protected $guarded = ['id' , 'created_at' , 'updated_at'];
}
