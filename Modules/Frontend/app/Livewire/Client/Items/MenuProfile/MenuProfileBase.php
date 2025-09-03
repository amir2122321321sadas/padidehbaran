<?php

namespace Modules\Frontend\Livewire\Client\Items\MenuProfile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MenuProfileBase extends Component
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth');
    }

    public function render()
    {
        return view('frontend::livewire.client.items.menu-profile.menu-profile-base');
    }
}
