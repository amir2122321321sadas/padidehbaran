<?php

namespace Modules\Frontend\Livewire\Client\Items\Menu\MenuBase;

use Livewire\Component;

class MenuItems extends Component
{
    public $menus;

    public function mount($menus)
    {
        $this->menus = $menus;
    }

    public function render()
    {
        return view('frontend::livewire.client.items.menu.menu-base.menu-items');
    }
}
