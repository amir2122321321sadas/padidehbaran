<?php

namespace Modules\Frontend\Livewire\Client\Items\Banner;

use Livewire\Component;

class BannerBase extends Component
{
    public $mainBanners;





    public function render()
    {
        return view('frontend::livewire.client.items.banner.banner-base',[
            'mainBanners' => $this->mainBanners,
        ]);
    }
}
