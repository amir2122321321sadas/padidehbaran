<?php

namespace Modules\Frontend\Livewire\Client\Items\Menu\MenuBase;

use App\Models\Menu;
use Livewire\Component;

class MenuItemsMobile extends Component
{

    public $menus;

    public function mount()
    {
        $this->menus = Menu::getActiveMenus();
    }

    public function render()
    {
        return view('frontend::livewire.client.items.menu.menu-base.menu-items-mobile');
    }
}
