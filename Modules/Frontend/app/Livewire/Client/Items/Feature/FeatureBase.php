<?php

namespace Modules\Frontend\Livewire\Client\Items\Feature;

use App\Models\ChangerItem;
use Livewire\Component;

class FeatureBase extends Component
{
    public $changerItems;

    public function mount($changerItems)
    {
        $this->changerItems = $changerItems;
    }

    public function render()
    {
        return view('frontend::livewire.client.items.feature.feature-base');
    }
}
