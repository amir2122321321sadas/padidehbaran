<?php

namespace Modules\Frontend\Livewire\Client\Pages\Course;

use App\Models\Course;
use App\Models\CourseChapterFile;
use Livewire\Attributes\Title;
use Livewire\Component;

class CoursesDetailFile extends Component
{
    public $course;

    public $chapters;
    public $courseChapterFile;

    public $countFilesCourse;

    public function mount(Course $course , CourseChapterFile $courseChapterFile)
    {
        $this->course = $course;
        $this->courseChapterFile = $courseChapterFile;
        $this->chapters = $this->course->chapters;
        $this->countFilesCourse = $course->courseChapterFiles->count();

    }

    #[Title('جلسات دوره')]
    public function render()
    {
        return view('frontend::livewire.client.pages.course.courses-detail-file');
    }
}
