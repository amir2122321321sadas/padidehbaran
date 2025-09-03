<?php

namespace Modules\Frontend\Livewire\Client\Items\Intro;

use App\Models\Banner;
use Livewire\Component;

class IntroBase extends Component
{

    public $banners;

    public function mount()
    {
        $this->banners = Banner::getActiveOtherBanners();
    }

    public function render()
    {
        return view('frontend::livewire.client.items.intro.intro-base');
    }
}
