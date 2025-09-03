<?php

namespace Modules\Frontend\Livewire\Client\Items\Menu\MenuBase;

use Livewire\Component;

class MenuItemsProfileSlider extends Component
{

    public $isAdmin = false;

    public function mount()
    {
        $user = auth()->user();
       $this->isAdmin = $user->hasRole('admin');

    }
    public function logout()
    {
        auth()->logout();
        return redirect(route('auth'));
    }

    public function render()
    {
        return view('frontend::livewire.client.items.menu.menu-base.menu-items-profile-slider');
    }

}
