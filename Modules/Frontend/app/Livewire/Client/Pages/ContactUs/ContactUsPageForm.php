<?php

namespace Modules\Frontend\Livewire\Client\Pages\ContactUs;

use App\Models\ContactUs;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactUsPageForm extends Component
{

    #[Validate('required|min:3|max:30')]
    public $full_name;

    #[Validate('required|regex:/^[\w\.-]+@[\w\.-]+\.\w{2,4}$/')]
    public $email;

    #[Validate('required|min:10|max:1000')]
    public $message;


    public function saveContactUs()
    {
        $this->validate();

        $contactUs = ContactUs::create([
            'full_name' => $this->full_name,
            'email' => $this->email,
            'message' => $this->message,
            'status' => 0,
        ]);
        session()->flash('status', 'پیام شما با موفقیت ثبت گردید و بعد از بررسی ، نتیجه به شما اطلاع داده خواهد شد.');
    }

    public function render()
    {
        return view('frontend::livewire.client.pages.contact-us.contact-us-page-form');
    }
}
