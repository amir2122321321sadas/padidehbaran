<?php

namespace Modules\Frontend\Livewire\Client\Items\Header;

use App\Models\InsurancePolicy;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeaderBase extends Component
{

    public $activeUser;
    public $userHasImageProfile;
    public $alert;
    public $insurance;

    public function mount()
    {

        $user = auth()->user();
        $this->alert = $user->alerts
            ->where('status', 1)
            ->sortByDesc('created_at')->first();


        $this->userHasImageProfile = Auth::user()->userNationalityData->face_image ?? null;
        $this->insurance = InsurancePolicy::where('user_id', auth()->id())->where('status' , 1)->first() ?? null;


        $this->activeUser = auth()->user()->is_active;
    }
    public function render()
    {
        return view('frontend::livewire.client.items.header.header-base');
    }
}
