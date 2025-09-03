<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsurancePolicy extends Model
{
    use softDeletes;
    protected $table = 'insurance_policies';
    protected $guarded = ['id' , 'created_at', 'updated_at'];

    public const STATUS_OPTIONS = [
        0 => 'غیرفعال',
        1 => 'فعال',
        2 => 'منتظر بررسی',
        3 => 'رد شده(منتظر ویرایش)',
    ];

    public const INSTALLMENT_TYPES = [
        0 => 'ماهیانه',
        1 => 'دوماهه',
        2 => 'سه ماهه',
        3 => 'چهارماهه',
        4 => 'شش ماهه',
        5 => 'سالیانه'
    ];

    public const TYPE_INSURANCE_POLICIES = [
        0 => 'تبسم(کاربرانی که اولین بیمه نامه شان است باید تبسم را انتخاب کنند)',
        1 => 'ترنم',
        2 => 'طراوت',
        3 => 'شاخص تورم',
        4 => 'مهرباران'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkerExcels()
    {
        return $this->hasMany(CheckerExcel::class, 'policy_number', 'insurance_policies_number');
    }

}
