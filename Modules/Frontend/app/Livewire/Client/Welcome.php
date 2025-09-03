<?php

namespace Modules\Frontend\Livewire\Client;

use App\Models\Banner;
use App\Models\ChangerItem;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Welcome extends Component
{
    public $mainBanners;
    public $changerItems;

    public function mount(){

        $this->mainBanners = Banner::getActiveMainBanners();
        $this->changerItems = ChangerItem::getActiveChangerItems();
    }

    #[Title('صفحه اصلی')]
    public function render()
    {
        return view('frontend::livewire.client.welcome');
    }


}
