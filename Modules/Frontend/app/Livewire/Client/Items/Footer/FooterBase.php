<?php

namespace Modules\Frontend\Livewire\Client\Items\Footer;

use App\Models\Menu;
use App\Models\Setting;
use App\Models\Term;
use Livewire\Component;

class FooterBase extends Component
{
    public $setting;
    public $menus;
    public function mount()
    {
        $this->setting = Setting::first();
        $this->menus = Menu::getActiveMenus();
    }
    public function render()
    {
        return view('frontend::livewire.client.items.footer.footer-base');
    }
}
