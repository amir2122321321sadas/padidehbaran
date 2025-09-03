<?php

namespace Modules\Frontend\View\Components;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Illuminate\View\View;

class Logo extends Component
{
    public $original_logo;
    /**
     * Create a new component instance.
     */
    public function __construct() {
        if ($this->original_logo = Setting::first()){
            $this->original_logo = Storage::url(Setting::first()->original_logo);
        }else{
            $this->original_logo = asset('apple-touch-icon.png');
        }

    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('frontend::components.logo');
    }
}
