<?php

namespace Modules\Frontend\Livewire\Client\Items\Banner;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class BannerBase extends Component
{
    #[Reactive]
    public $mainBanners;

    public function boot()
    {
        dd('je;;sdfsdsa');
    }
    public function mount($mainBanners)
    {
        $this->mainBanners = $mainBanners;
    }


    public function render()
    {
        return view('frontend::livewire.client.items.banner.banner-base',[
            'mainBanners' => $this->mainBanners,
        ]);
    }
}
