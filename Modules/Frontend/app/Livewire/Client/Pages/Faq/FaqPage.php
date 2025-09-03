<?php

namespace Modules\Frontend\Livewire\Client\Pages\Faq;

use App\Models\Faq;
use Livewire\Attributes\Title;
use Livewire\Component;

class FaqPage extends Component
{
    public $faqs;

    public function mount()
    {
        $this->faqs = Faq::getActiveFaqs();
    }
    #[Title('سوالات متداول')]
    public function render()
    {
        return view('frontend::livewire.client.pages.faq.faq-page');
    }
}
