<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserView extends Model
{
    use softDeletes;
    protected $table = 'user_views';
    protected $guarded = ['id' , 'created_at' , 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseFile()
    {
        return $this->belongsTo(CourseChapterFile::class , 'course_file_id');
    }


}
