<?php

namespace Modules\Frontend\Livewire\Client\Items\Course;

use App\Models\Course;
use Livewire\Component;

class CourseBase extends Component
{
    public $courses;

    public function mount()
    {
        $user = auth()->user();

        //با استفاده از level_id level رو پیدا می کنه و بر اساس اون level خود کاربر course_id هایی که برای اون سطح از طریق پنل ادمین انتخاب شده اند برگردانده میشوند!
        $this->courses = $user->activeCoursesFromLevel();

    }

    public function render()
    {
        return view('frontend::livewire.client.items.course.course-base');
    }
}
