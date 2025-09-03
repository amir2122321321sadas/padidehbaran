<?php

namespace Modules\Frontend\Livewire\Client\Pages\Profile;

use App\Models\Ticket;
use Coderflex\LaravelTicket\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateTicketProfilePage extends Component
{

    use WithFileUploads;

    public $categories;

    #[Validate]
    public $category;

    #[Validate]
    public $title;

    #[Validate]
    public $message;

    public $priorities = [
        'low' => 'کم',
        'medium' => 'متوسط',
        'high' => 'زیاد',
        'critical' => 'بحرانی',
    ];

    #[Validate]
    public $file;
    #[Validate]
    public $priority;


    public function rules(): array
    {
        return [
          'category' => 'required',
            'title' => 'required|max:255|min:3',
            'message' => 'required|min:5',
            'priority' => 'required|in:low,medium,high,critical',
            'file' => 'nullable|file|max:10000',
        ];
    }

    public function save()
    {
        $validate = $this->validate();
        $user = Auth::user()->id;

        $category = Category::where('id' , $this->category)->first();

        $ticket = Ticket::create([
                'uuid' => Str::uuid(),
                'title' => $this->title,
                'message' => $this->message,
                'priority' => $this->priority,
                'user_id' => $user,
                'status' => 'pending',
            ]);

        $ticket->attachCategories($ticket->attachCategories([$this->category]));

        if ($this->file) {
            $ticket->addMedia($this->file)->toMediaCollection('attachments');
        }




        return redirect()->route('ticket-list');

    }

    public function mount()
    {
        $this->categories = Category::visible()->get();
    }

    #[Title('ارسال تیکت')]
    public function render()
    {
        return view('frontend::livewire.client.pages.profile.create-ticket-profile-page')
            ->extends('components.layouts.profile')
            ->section('content');
    }
}
