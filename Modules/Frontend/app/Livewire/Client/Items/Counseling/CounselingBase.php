<?php

namespace Modules\Frontend\Livewire\Client\Items\Counseling;

use App\Models\Banner;
use Livewire\Component;

class CounselingBase extends Component
{
    public $banners;

    public function mount()
    {
        $this->banners = Banner::getActiveMiddleMainBanners();
    }

    public function render()
    {
        return view('frontend::livewire.client.items.counseling.counseling-base');
    }
}
