<?php

namespace Modules\Frontend\Livewire\Client\Items\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Morilog\Jalali\Jalalian;

class TabOneProfileForm extends Component
{
    #[Validate('required|max:30|regex:/^[\x{0600}-\x{06FF}\s]+$/u')]
    public $first_name;

    #[Validate('required|max:40|regex:/^[\x{0600}-\x{06FF}\s]+$/u')]
    public $last_name;

    #[Validate('required|max:40|regex:/^[\x{0600}-\x{06FF}\s]+$/u')]
    public $father_name;


    #[Locked]
    public $national_code;

    #[Validate]
    public $birth_certificate_number;

    public function rules()
    {
        return [
            'birth_certificate_number' => [
                'required',
                'max:10',
                Rule::unique('user_information', 'birth_certificate_number')
                    ->ignore(auth()->id(), 'user_id')
            ]
        ];
    }


    #[Validate('required')]
    public $date_of_birth;

    #[Validate('required|max:11|min:10')]
    public $phone;

    #[Validate('required|digits:10')]
    public $postal_code;

    #[Validate('required')]
    public $address;

    #[Locked]
    public $identification_code;

    public $user;

    public function mount()
    {
        $this->user = Auth::user();
        $this->first_name = Auth::user()->userInformation->first_name;
        $this->last_name = Auth::user()->userInformation->last_name;
        $this->father_name = Auth::user()->userInformation->father_name;
        $this->national_code = Auth::user()->userInformation->national_code;
        $this->birth_certificate_number = Auth::user()->userInformation->birth_certificate_number;
        $this->date_of_birth = Jalalian::fromCarbon(
            \Carbon\Carbon::parse(Auth::user()->userInformation->date_of_birth)
        )->format('Y/m/d');  // یا 'Y-m-d' بسته به سلیقه;
        $this->phone = Auth::user()->userInformation->phone;
        $this->postal_code = Auth::user()->userInformation->postal_code;
        $this->address = Auth::user()->userInformation->address;
        $this->identification_code = Auth::user()->userInformation->owner
            ? Auth::user()->userInformation->owner->identification_code . ' ('
            . (Auth::user()->userInformation->owner->userInformation?->first_name ?? 'معرف شما نام و نام خانوادگی') . ' '
            . (Auth::user()->userInformation->owner->userInformation?->last_name ?? 'ندارد!') . ')'
            : 'وارد نشده است';

    }

    public function saveProfile()
    {
        $this->validate();
        $this->user = Auth::user();
        $userInfo = $this->user->userInformation;

//        if ($userInfo->birth_certificate_number && $userInfo->birth_certificate_number !=  $this->birth_certificate_number) {
//            $this->addError('birth_certificate_number', 'شماره شناسنامه شما قبلا ثبت شده و قابل تغییر نمیباشد!');
//            return;
//        }

        $userInfo->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'father_name' => $this->father_name,
            'birth_certificate_number' => $this->birth_certificate_number,
            'date_of_birth' => Jalalian::fromFormat('Y/m/d', $this->date_of_birth)->toCarbon()->format('Y-m-d'),
            'phone' => $this->phone,
            'postal_code' => $this->postal_code,
            'address' => $this->address,
        ]);
        session()->flash('success', 'اطلاعات با موفقیت ذخیره شد.');
    }

    public function render()
    {
        return view('frontend::livewire.client.items.profile.tab-one-profile-form');
    }
}
