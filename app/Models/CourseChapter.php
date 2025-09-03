<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseChapter extends Model
{
    use softDeletes , Sluggable;
    protected $table = 'course_chapters';
    protected $guarded = ['id' , 'created_at' , 'updated_at'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class , 'course_id');
    }

    public function files()
    {
        return $this->hasMany(CourseChapterFile::class , 'course_chapter_id');
    }
}
