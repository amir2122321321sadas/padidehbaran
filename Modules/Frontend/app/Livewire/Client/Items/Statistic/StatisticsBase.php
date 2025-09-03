<?php

namespace Modules\Frontend\Livewire\Client\Items\Statistic;

use App\Models\InsurancePolicy;
use App\Models\Level;
use Livewire\Component;

class StatisticsBase extends Component
{

    public $activeUser;
    public $countInsurancePolicy;
    public $countCoursesUser;

    public $level;

    public $countUnPaidInsurancePolicies;


    public function mount()
    {
        $user = auth()->user();
        $this->level = Level::where('order_level' , $user->level_id)->first();
        $this->countCoursesUser = $user->activeCoursesFromLevel()->count();
        $this->activeUser = $user->is_active;
        $this->countInsurancePolicy = $user->insurancePolicies->where('status' , 1)->count() ?? null;
        $this->countUnPaidInsurancePolicies = $user->insurancePolicies->where('un_paid' , 'true')->count() ?? null;
    }
    public function render()
    {
        return view('frontend::livewire.client.items.statistic.statistics-base');
    }
}
