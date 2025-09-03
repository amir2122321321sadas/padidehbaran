<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Maize\Markable\Markable;
use Maize\Markable\Models\Like;

class Course extends Model
{
    use softDeletes , Sluggable , Markable;
    protected $table = 'courses';
    protected $guarded = ['id' , 'created_at' , 'updated_at'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function getActiveCourses()
    {
        return self::where('status', 1)->get();
    }


    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function chapters()
    {
        return $this->hasMany(CourseChapter::class, 'course_id');
    }

    public function courseChapterFiles()
    {
        return $this->hasMany(CourseChapterFile::class);
    }
    protected static $marks = [
        Like::class,
    ];
}
