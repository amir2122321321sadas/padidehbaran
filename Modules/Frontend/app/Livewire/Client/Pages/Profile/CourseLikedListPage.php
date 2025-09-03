<?php

namespace Modules\Frontend\Livewire\Client\Pages\Profile;

use App\Models\Course;
use Livewire\Attributes\Title;
use Livewire\Component;

class CourseLikedListPage extends Component
{
    public $courses;

    public function mount()
    {
        $this->courses = Course::whereHasLike(
            auth()->user()
        )->get(); // returns all course models with a like from the given user;
    }

    #[Title('علاقه مندی ها')]
    public function render()
    {
        return view('frontend::livewire.client.pages.profile.course-liked-list-page')
            ->extends('components.layouts.profile')
            ->section('content');
    }
}
