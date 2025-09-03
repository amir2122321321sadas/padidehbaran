<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Livewire\WithFileUploads;

class UserNationalityData extends Model
{
    use softDeletes , WithFileUploads;
    protected $table = 'user_nationality_datas';
    protected $guarded = ['id' , 'created_at' , 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
