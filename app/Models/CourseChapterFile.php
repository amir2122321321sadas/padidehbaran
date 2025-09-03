<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseChapterFile extends Model
{
    use softDeletes , Sluggable;
    protected $table = 'course_chapter_files';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function courseChapter()
    {
        return $this->belongsTo(CourseChapter::class , 'course_chapter_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class , 'teacher_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class , 'course_id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
