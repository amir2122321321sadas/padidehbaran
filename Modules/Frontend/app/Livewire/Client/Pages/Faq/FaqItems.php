<?php

namespace Modules\Frontend\Livewire\Client\Pages\Faq;

use Livewire\Component;

class FaqItems extends Component
{
    public $faq;

    public function mount($faq)
    {
        $this->faq = $faq;
    }
    public function render()
    {
        return view('frontend::livewire.client.pages.faq.faq-items');
    }
}
