<?php

namespace App\Models;

use Althinect\FilamentSpatieRolesPermissions\Commands\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role;

class LevelChanger extends Model
{
    use SoftDeletes;
    protected $table = 'level_changer';

    protected $guarded = ['id' , 'created_at' , 'updated_at'];

   public function level()
   {
       return $this->belongsTo(Level::class , 'level_id');
   }


}
