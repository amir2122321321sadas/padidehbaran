<?php

namespace Modules\Frontend\Livewire\Client\Pages\Term;

use App\Models\Term;
use Livewire\Attributes\Title;
use Livewire\Component;

class TermPage extends Component
{
    public $term;
    public function mount()
    {
        $this->term = Term::getActiveTerm();
    }
    #[Title('قوانین و مقررات وبسایت')]
    public function render()
    {
        return view('frontend::livewire.client.pages.term.term-page');
    }
}
