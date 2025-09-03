<?php

namespace Modules\Frontend\Livewire\Client\Pages\ContactUs;

use App\Models\ContactUs;
use App\Models\PageContactUs;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactUsPage extends Component
{
    public $pageData;
    public function mount(){
        $this->pageData = PageContactUs::first();
    }

    #[Title('تماس باما')]
    public function render()
    {
        return view('frontend::livewire.client.pages.contact-us.contact-us-page');
    }
}
