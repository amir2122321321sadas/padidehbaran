<?php

namespace Modules\Frontend\Livewire\Client\Pages\Profile;

use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Morilog\Jalali\Jalalian;

class CreateInsurancePoliciesProfilePage extends Component
{

    #[Title('ثبت بیمه نامه')]
    public function render()
    {
        return view('frontend::livewire.client.pages.profile.create-insurance-policies-profile-page')
            ->extends('components.layouts.profile')
            ->section('content');
    }
}
