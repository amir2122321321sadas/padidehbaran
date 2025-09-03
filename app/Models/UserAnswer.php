<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $table = 'user_answers';
    protected $fillable = ['user_exam_id', 'question_id', 'option_id'];

    public function userExam() {
        return $this->belongsTo(UserExam::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function option() {
        return $this->belongsTo(Option::class);
    }
}
