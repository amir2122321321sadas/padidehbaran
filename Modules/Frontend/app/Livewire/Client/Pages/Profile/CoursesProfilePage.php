<?php

namespace Modules\Frontend\Livewire\Client\Pages\Profile;

use App\Models\Setting;
use Livewire\Attributes\Title;
use Livewire\Component;

class CoursesProfilePage extends Component
{

    public $courses;
    public $setting;

    public function mount()
    {
        $user = auth()->user();

        //با استفاده از level_id level رو پیدا می کنه و بر اساس اون level خود کاربر course_id هایی که برای اون سطح از طریق پنل ادمین انتخاب شده اند برگردانده میشوند!
        $this->courses = $user->activeCoursesFromLevel();

        $this->setting = Setting::first();

    }

    #[Title('دوره های شما')]
    public function render()
    {
        return view('frontend::livewire.client.pages.profile.courses-profile-page')
            ->extends('components.layouts.profile')
            ->section('content');
    }
}
