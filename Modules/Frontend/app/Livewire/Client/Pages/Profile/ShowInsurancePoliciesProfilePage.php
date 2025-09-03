<?php

namespace Modules\Frontend\Livewire\Client\Pages\Profile;

use App\Models\InsurancePolicy;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ShowInsurancePoliciesProfilePage extends Component
{


    public $insurance_policies_number;


    public $date_of_issue;


    public $type_insurance_policies;


    public $images;


    public $installment_type;


    public $amount_of_each_installment;

    public $status;

    public $checkerExcels;

    public $unPaid;

    public function mount($insurance_policies_number)
    {
        $insurance_policy = InsurancePolicy::where('insurance_policies_number', $insurance_policies_number)->first();
        if (!$insurance_policy) {
            return abort(404);
        }
        $this->insurance_policies_number = $insurance_policy->insurance_policies_number;
        $this->date_of_issue = $insurance_policy->date_of_issue;
        $this->type_insurance_policies = $insurance_policy->type_insurance_policies;
        $this->images = $insurance_policy->images;
        $this->installment_type = $insurance_policy->installment_type;
        $this->amount_of_each_installment = $insurance_policy->amount_of_each_installment;
        $this->status = InsurancePolicy::STATUS_OPTIONS[$insurance_policy->status];
        $this->checkerExcels = $insurance_policy->checkerExcels;
        $this->unPaid = $insurance_policy->un_paid;
    }


    #[Title('مشاهده بیمه نامه')]
    public function render()
    {
        return view('frontend::livewire.client.pages.profile.show-insurance-policies-profile-page')
            ->extends('components.layouts.profile')
            ->section('content');
    }
}
