<?php

namespace Modules\Frontend\View\Components\UserInformation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;
use Illuminate\View\View;

class AvatarProfileUserLink extends Component
{
    /**
     * Create a new component instance.
     */
    public $linkAvatar;
    public function __construct() {
        if (Auth::user()->userNationalityData){
            $this->linkAvatar =  Storage::url(Auth::user()->userNationalityData->face_image);
        }else{
            $this->linkAvatar = asset('assets/images/avatars/01.jpeg');
        }
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('frontend::components.userinformation/avatarprofileuserlink');
    }
}
