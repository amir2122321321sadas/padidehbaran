<?php

namespace Modules\Frontend\Livewire\Client\Items\Profile\Data;

use App\Events\UserProgressChecked;
use App\Models\Level;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Morilog\Jalali\Jalalian;

class CreateInsurancePoliciesProfile extends Component
{
    use WithFileUploads;

    #[Validate]
    public $insurance_policies_number;

    #[Validate]
    public $date_of_issue;

    #[Validate]
    public $type_insurance_policies;

    #[Validate]
    public $images = [];

    #[Validate]
    public $installment_type;

    #[Validate]
    public $amount_of_each_installment;

    public function rules()
    {
        return [
            'insurance_policies_number' => 'required|string|min:1|max:255|unique:insurance_policies,insurance_policies_number',
            'date_of_issue' => 'required|date',
            'type_insurance_policies' => 'required|in:' . implode(',', array_keys(\App\Models\InsurancePolicy::TYPE_INSURANCE_POLICIES)),
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'installment_type' => 'required|in:' . implode(',', array_keys(\App\Models\InsurancePolicy::INSTALLMENT_TYPES)),
            'amount_of_each_installment' => 'required|integer|min:1',
        ];
    }


    public function mount()
    {

        $user = auth()->user();
        event(new UserProgressChecked($user));

    }

    public function save()
    {
        $this->validate();

        $imageMap = [];
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $uuid = \Illuminate\Support\Str::uuid()->toString();
                $path = $image->store('uploads/images/insurance/images', 'public');
                $imageMap[$uuid] = $path;
            }
        }

        \App\Models\InsurancePolicy::create([
            'user_id' => auth()->id(),
            'insurance_policies_number' => $this->insurance_policies_number,
            'date_of_issue' => Jalalian::fromFormat('Y/m/d', $this->date_of_issue)->toCarbon()->format('Y-m-d'),
            'type_insurance_policies' => $this->type_insurance_policies,
            'images' => json_encode($imageMap),
            'installment_type' => $this->installment_type,
            'amount_of_each_installment' => $this->amount_of_each_installment,
            'status' => 2, // فرض بر این که وضعیت اولیه "منتظر بررسی" است
        ]);

        session()->flash('success', 'بیمه نامه با موفقیت ثبت گردید و منتظر تایید می باشد.');

        $this->insurance_policies_number = null;
        $this->date_of_issue = null;
        $this->type_insurance_policies = null;
        $this->images = [];
        $this->installment_type = null;
        $this->amount_of_each_installment = null;

        $user = auth()->user();
        event(new UserProgressChecked($user));


    }

    public function render()
    {
        return view('frontend::livewire.client.items.profile.data.create-insurance-policies-profile');
    }
}
