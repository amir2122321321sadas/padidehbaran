<?php

namespace Modules\Frontend\Livewire\Client\Items\Feature\FeatureBase;

use Livewire\Component;

class FeatureItems extends Component
{
    public $changerItems;

    public function mount($changerItems)
    {
        $this->changerItems = $changerItems;
    }
    public function render()
    {
        return view('frontend::livewire.client.items.feature.feature-base.feature-items');
    }
}
