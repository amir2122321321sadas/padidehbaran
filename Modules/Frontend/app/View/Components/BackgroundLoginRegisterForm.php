<?php

namespace Modules\Frontend\View\Components;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Illuminate\View\View;

class BackgroundLoginRegisterForm extends Component
{
    public $background;

    public function __construct()
    {
        $setting = Setting::first();

        if ($setting && $setting->background_login_page) {
            $this->background = Storage::url($setting->background_login_page);
        } else {
            $this->background = 'https://lh5.googleusercontent.com/proxy/55XFDWjKgbhHr3eem3i7et_mKauf7m1o3oZU-soT6bQ9r4lwHq-zjR78ZKQdmDxEDksmXrD8g4Nuh4YJSmUMDydYLRP3VQ';
        }
    }

    public function render(): View|string
    {
        return view('frontend::components.backgroundloginregisterform');
    }
}
