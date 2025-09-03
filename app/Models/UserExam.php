<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExam extends Model
{
    protected $table = 'user_exams';
    protected $fillable = ['user_id', 'exam_id', 'score' , 'full_name' , 'token' , 'phone' , 'test_check_id' , 'email'];


    public function exam() {
        return $this->belongsTo(Exam::class);
    }

    public function answers() {
        return $this->hasMany(UserAnswer::class);
    }
}
