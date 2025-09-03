<?php

namespace Modules\Frontend\Livewire\Client\Items\Intro\IntroBase;

use Livewire\Component;

class IntroItems extends Component
{
    public $banner;

    public function mount($banner)
    {
        $this->banner = $banner;
    }

    public function render()
    {
        return view('frontend::livewire.client.items.intro.intro-base.intro-items');
    }
}
