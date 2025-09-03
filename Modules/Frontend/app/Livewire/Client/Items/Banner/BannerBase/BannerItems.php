<?php

namespace Modules\Frontend\Livewire\Client\Items\Banner\BannerBase;

use Livewire\Component;

class BannerItems extends Component
{
    public $mainBanner;

    public function mount($mainBanner)
    {
        $this->mainBanner = $mainBanner;
    }


    public function render()
    {
        return view('frontend::livewire.client.items.banner.banner-base.banner-items');
    }
}
