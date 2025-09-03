<?php

namespace Modules\Frontend\Livewire\Client\Pages\Course;

use App\Models\Course;
use Livewire\Attributes\Title;
use Livewire\Component;
use Maize\Markable\Models\Like;

class CoursesDetail extends Component
{
    public $course;

    public $chapters;

    public $color = 'primary';
    public $isLike  = false;

    public $user;

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->chapters = $this->course->chapters;

        $this->user = auth()->user();

        $this->isLike = Like::has($this->course, $this->user); // returns whether the given user has marked as liked the course or not
        if ($this->isLike){
            $this->color = 'red';
        }else{
            $this->color = 'primary';
        }
    }


    public function like()
    {
        Like::add($this->course, $this->user); // marks the course liked for the given user
        $this->isLike = true;
        $this->color = 'bg-red';
    }

    public function dislike()
    {
        Like::remove($this->course, $this->user);
        $this->isLike = false;
        $this->color = 'bg-background';
    }


    #[Title('دوره آموزشی')]
    public function render()
    {
        return view('frontend::livewire.client.pages.course.courses-detail');
    }
}
