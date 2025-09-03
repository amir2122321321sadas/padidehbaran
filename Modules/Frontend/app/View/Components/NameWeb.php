<?php

namespace Modules\Frontend\View\Components;

use App\Models\Setting;
use http\Env;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Illuminate\View\View;

class NameWeb extends Component
{
    public $web_name = 'laravel';
    /**
     * Create a new component instance.
     */
    public function __construct() {
        if ($this->web_name = Setting::first()){
            $this->web_name = Setting::first()->web_name;
        }else{
            $this->web_name = 'laravel';
        }
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('frontend::components.nameweb');
    }
}
