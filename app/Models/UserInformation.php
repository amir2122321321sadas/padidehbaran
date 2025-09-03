<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInformation extends Model
{
    use SoftDeletes;

    protected $table = 'user_information';

    protected $guarded = [
        'id' , 'created_at', 'updated_at'
    ];

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'father_name',
        'national_code',
        'birth_certificate_number',
        'date_of_birth',
        'phone',
        'postal_code',
        'address',
        'identification_code'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class , 'identification_code');
    }


    
}
