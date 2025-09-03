<?php

namespace Modules\Frontend\Livewire\Client\Items\Profile;

use Livewire\Attributes\Validate;
use Livewire\Component;

class TabTreeProfileForm extends Component
{
    #[Validate]
    public $current_password;

    #[Validate]
    public $new_password;

    #[Validate]
    public $confirm_password;

    public function rules()
    {
        return [
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ];
    }

    public function changePassword()
    {
        $this->validate();

        // فرض می‌کنیم کاربر فعلی را می‌توان از auth()->user() گرفت
        $user = auth()->user();

        // بررسی صحت رمز عبور فعلی
        if (!\Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'رمز عبور فعلی اشتباه است.');
            return;
        }

        // تغییر رمز عبور
        $user->password = bcrypt($this->new_password);
        $user->save();

        // ریست فیلدها
        $this->current_password = '';
        $this->new_password = '';
        $this->confirm_password = '';

        session()->flash('success', 'رمز عبور با موفقیت تغییر کرد.');
    }
    public function render()
    {
        return view('frontend::livewire.client.items.profile.tab-tree-profile-form');
    }
}
