<?php

namespace Modules\Frontend\Livewire\Client\Items\Profile;

use App\Models\Course;
use Livewire\Component;

class CoursesProfileItems extends Component
{
    public $course;
    public function mount(Course $course)
    {
        $this->course = $course;
    }

    public function render()
    {
        return view('frontend::livewire.client.items.profile.courses-profile-items');
    }
}
