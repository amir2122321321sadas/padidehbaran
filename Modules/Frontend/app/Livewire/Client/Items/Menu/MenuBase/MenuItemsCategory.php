<?php

namespace Modules\Frontend\Livewire\Client\Items\Menu\MenuBase;

use App\Models\CourseCategory;
use App\Models\Menu;
use Livewire\Component;

class MenuItemsCategory extends Component
{
    public $categories;

    public function mount(){
        $this->categories = CourseCategory::getActiveCategories();
    }

    public function render()
    {
        return view('frontend::livewire.client.items.menu.menu-base.menu-items-category');
    }
}
