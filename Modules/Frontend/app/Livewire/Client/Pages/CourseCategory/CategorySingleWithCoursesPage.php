<?php

namespace Modules\Frontend\Livewire\Client\Pages\CourseCategory;

use App\Models\CourseCategory;
use Livewire\Attributes\Title;
use Livewire\Component;
use Maize\Markable\Models\Like;

class CategorySingleWithCoursesPage extends Component
{
    public $category;

    public $courses;

    public $search = '';



    public function mount(CourseCategory $courseCategory)
    {
        $this->category = $courseCategory;

        $this->updateCourses();
    }



    public function updatedSearch()
    {
        $this->updateCourses();
    }

    protected function updateCourses()
    {
        $query = $this->category->courses();

        if (!empty($this->search)) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        $this->courses = $query->get();
    }

    #[Title('دسته بندی')]
    public function render()
    {
        return view('frontend::livewire.client.pages.course-category.category-single-with-courses-page');
    }
}
