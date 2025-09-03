<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckerExcel extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = 'checker_excels';

    protected $guarded = ['id' , 'created_at' , 'updated_at'];

    public function insurance()
    {
        return $this->belongsTo(InsurancePolicy::class , 'policy_number' , 'id');
    }

    // رابطه با InsurancePolicy
    public function insurancePolicies()
    {
        return $this->hasMany(InsurancePolicy::class, 'insurance_policies_number', 'policy_number')
            ->where('status', 1);
    }

}
