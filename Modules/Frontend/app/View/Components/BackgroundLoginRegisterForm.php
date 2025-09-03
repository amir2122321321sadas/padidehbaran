<?php

namespace Modules\Frontend\View\Components;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Illuminate\View\View;

class BackgroundLoginRegisterForm extends Component
{
    public $background;
    /**
     * Create a new component instance.
     */
    public function __construct() {
        if ($this->background = Setting::first()){
            $this->background = Storage::url(Setting::first()->background_login_page);
        }else{
            $this->background = 'https://lh5.googleusercontent.com/proxy/55XFDWjKgbhHr3eem3i7et_mKauf7m1o3oZU-soT6bQ9r4lwHq-zjR78ZKQdmDxEDksmXrD8g4Nuh4YJSmUMDydYLRP3VQ';
        }
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('frontend::components.backgroundloginregisterform');
    }
}
