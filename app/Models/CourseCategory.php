<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseCategory extends Model
{
    use softDeletes , Sluggable;
    protected $table = 'course_categories';
    protected $guarded = ['id' , 'created_at' , 'updated_at'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public static function getActiveCategories()
    {
        return self::where('status', 1)
            ->get();
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'category_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'category_id');
    }
}
