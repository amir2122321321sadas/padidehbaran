<?php

namespace Modules\Frontend\Livewire\Client\Items\Menu;

use App\Models\Menu;
use Livewire\Component;

class MenuBase extends Component
{
    public $menus;

    public function mount(){
        $this->menus = Menu::getActiveMenus();
    }
    public function render()
    {
        return view('frontend::livewire.client.items.menu.menu-base');
    }
}
