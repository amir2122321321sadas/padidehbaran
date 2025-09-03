<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use Sluggable , SoftDeletes;
    protected $table = 'exams';
    protected $guarded = ['id' , 'created_at' , 'updated_at'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function userExams()
    {
        return $this->hasMany(UserExam::class);
    }

}
