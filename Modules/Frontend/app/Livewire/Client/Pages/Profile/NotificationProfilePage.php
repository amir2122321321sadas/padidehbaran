<?php

namespace Modules\Frontend\Livewire\Client\Pages\Profile;

use App\Models\Alert;
use App\Models\Meeting;
use Livewire\Attributes\Title;
use Livewire\Component;

class NotificationProfilePage extends Component
{
    public $meetings_user;
    public $alertsChangeLevel;

    public function mount()
    {
        $user = auth()->user();
        if ($user->alerts
            ->where('status', 2)
            ->sortByDesc('created_at')){
            $this->alertsChangeLevel = $user->alerts
                ->where('status', 2)
                ->sortByDesc('created_at');
        }else{
            $this->alertsChangeLevel = $user->alerts
                ->where('status', 1)
                ->sortByDesc('created_at');
        }

       $this->meetings_user = Meeting::getMeetingsForCurrentUser();
    }

    #[Title('اعلانات کاربر')]
    public function render()
    {
        return view('frontend::livewire.client.pages.profile.notification-profile-page')
            ->extends('components.layouts.profile')
            ->section('content');
    }
}
