<?php

namespace Modules\Frontend\Livewire\Client\Pages\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Morilog\Jalali\Jalalian;

class EditProfilePage extends Component
{

    #[Title('ویرایش اطلاعات کاربری')]
    public function render()
    {
        return view('frontend::livewire.client.pages.profile.edit-profile-page')
            ->extends('components.layouts.profile')
            ->section('content');
    }
}
