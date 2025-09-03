<?php

namespace Modules\Frontend\Livewire\Client\Pages\Profile;

use App\Models\Ticket;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShowTicketProfilePage extends Component
{
    use  WithFileUploads;

    public $file;

    public $ticket;

    public $messages;
    public $answers;
    public $user;
    public $category;

    public $newMessage;


    public function rules(): array
    {
        return [
            'message' => 'required|min:3',
        ];
    }

    public function mount(Ticket $ticket)
    {
        $this->user = $ticket->user;
        // لود تیکت به همراه دسته‌بندی‌ها
        $this->ticket = $ticket->load('categories');
        // پیام‌ها به ترتیب زمانی صعودی و همراه با کاربر
        $this->messages = $ticket->messages()->orderBy('created_at', 'asc')->with('user')->get();
        $this->category = $this->ticket->categories()->first();
        $this->answers = $this->messages->where('user_id' , '!=' , $this->user->id);

    }

    public function saveMessage()
    {
        // چک طول پیام
        if (strlen(trim($this->newMessage)) < 3) {
            $this->addError('newMessage', 'این فیلد اجباری است، حداقل 3 کاراکتر وارد شود');
            return; // پیام ثبت نمی‌شود
        }

        $message = $this->ticket->message($this->newMessage);

        if ($this->file) {
            $message->addMedia($this->file)->toMediaCollection('attachments');
        }

        $this->ticket->update([
            'status' => 'pending'
        ]);
        $this->messages = $this->ticket->messages()->with('user')->orderBy('created_at')->get();

// خالی کردن فرم
        $this->reset(['file' , 'newMessage']);
    }





    #[Title('مشاهده تیکت')]
    public function render()
    {
        return view('frontend::livewire.client.pages.profile.show-ticket-profile-page')
            ->extends('components.layouts.profile')
            ->section('content');
    }
}
