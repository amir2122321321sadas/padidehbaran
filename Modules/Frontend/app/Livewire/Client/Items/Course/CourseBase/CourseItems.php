<?php

namespace Modules\Frontend\Livewire\Client\Items\Course\CourseBase;

use App\Models\Course;
use Livewire\Component;
use Maize\Markable\Models\Like;

class CourseItems extends Component
{
    public $course;
    public $user;
    public $color = 'primary';
    public $isLike  = false;


    public function mount($course)
    {
        $this->user = auth()->user();
        $this->course = $course;
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

    public function render()
    {
        return view('frontend::livewire.client.items.course.course-base.course-items');
    }
}
