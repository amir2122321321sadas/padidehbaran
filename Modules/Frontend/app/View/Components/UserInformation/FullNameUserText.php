<?php

namespace Modules\Frontend\View\Components\UserInformation;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\View\View;

class FullNameUserText extends Component
{
    /**
     * Create a new component instance.
     */
    public $fullName;
    public function __construct() {
        $this->fullName = Auth::user()->userInformation->first_name .' '. Auth::user()->userInformation->last_name;
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('frontend::components.userinformation/fullnameusertext');
    }
}
