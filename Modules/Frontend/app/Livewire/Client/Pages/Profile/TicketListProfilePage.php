<?php

namespace Modules\Frontend\Livewire\Client\Pages\Profile;

use Coderflex\LaravelTicket\Models\Ticket;
use Faker\Core\Uuid;
use Livewire\Attributes\Title;
use Livewire\Component;

class TicketListProfilePage extends Component
{

    public $tickets;

    public function mount()
    {

        $this->tickets = auth()->user()
            ->tickets()
            ->latest()
            ->get();

    }

    #[Title('تیکت ها')]
    public function render()
    {
        return view('frontend::livewire.client.pages.profile.ticket-list-profile-page')
            ->extends('components.layouts.profile')
            ->section('content');
    }
}
