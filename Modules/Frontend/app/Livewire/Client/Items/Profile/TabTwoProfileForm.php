<?php

namespace Modules\Frontend\Livewire\Client\Items\Profile;

use App\Models\UserNationalityData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class TabTwoProfileForm extends Component
{

    use WithFileUploads;
    #[Validate]
    public $card_number;

    #[Validate]
    public $shaba_number;

    #[Validate]
    public $face_image;

    #[Validate]
    public $image_national_card;

    #[Validate]
    public $birth_certificate;

    #[Validate]
    public $image_educational_qualification;

    #[Validate]
    public $image_promissory_note;

    public function mount()
    {
        $user = UserNationalityData::where('user_id' , Auth::id())->first();
        $this->card_number = $user->card_number ?? '';
        $this->shaba_number = $user->shaba_number ?? '';
        $this->face_image = $user->face_image ?? '';
        $this->image_national_card = $user->image_national_card ?? '';
        $this->birth_certificate = $user->birth_certificate ?? '';
        $this->image_educational_qualification = $user->image_educational_qualification ?? '';
        $this->image_promissory_note = $user->image_promissory_note ?? '';

    }
    public function rules()
    {
        return [
            'card_number' => [
                'required',
                'string',
                'min:19',
                'max:19',
                'regex:/^6104/',
                Rule::unique('user_nationality_datas', 'card_number')->ignore(auth()->id(), 'user_id'),
            ],
            'shaba_number' => [
                'required',
                'numeric',
                'digits:22',
                Rule::unique('user_nationality_datas', 'shaba_number')->ignore(auth()->id(), 'user_id'),
            ],
            'face_image' => [
                'required',
                'max:1024',
            ],
            'image_national_card' => [
                'required',
                'max:2048',
            ],
            'birth_certificate' => [
                'required',
                'max:2048',
            ],
            'image_educational_qualification' => [
                'required',
                'max:4096',
            ],
            'image_promissory_note' => [
                'required',
                'max:4096',
            ]



        ];
    }

    public function saveOrUpdate()
    {
        $this->validate();

        $userId = auth()->id();

        // مسیر ذخیره سازی تصاویر
        $storagePath = 'uploads/UserNationalityData/Images';

        // گرفتن رکورد قبلی اگر وجود دارد
        $userData = \App\Models\UserNationalityData::where('user_id', $userId)->first();

        // تابع کمکی برای ذخیره تصویر و حذف قبلی
        $saveImage = function ($field, $maxSize = 4096) use ($userData, $storagePath) {
            if (request()->hasFile($field)) {
                $file = request()->file($field);

                // حذف تصویر قبلی اگر وجود دارد
                if ($userData && $userData->$field) {
                    \Storage::disk('public')->delete($userData->$field);
                }

                // نام جدید یکتا
                $filename = uniqid($field . '_') . '.' . $file->getClientOriginalExtension();

                // ذخیره سازی
                $path = $file->storeAs($storagePath, $filename, 'public');
                return $path;
            } elseif ($this->$field && is_object($this->$field)) {
                // اگر از Livewire فایل آپلود شده باشد
                if ($userData && $userData->$field) {
                    \Storage::disk('public')->delete($userData->$field);
                }
                $filename = uniqid($field . '_') . '.' . $this->$field->getClientOriginalExtension();
                $path = $this->$field->storeAs($storagePath, $filename, 'public');
                return $path;
            } else {
                // اگر هیچ فایلی نبود
                return $userData ? $userData->$field : null;
            }
        };

        // ذخیره تصاویر و گرفتن مسیر جدید
        $face_image = $saveImage('face_image', 1024);
        $image_national_card = $saveImage('image_national_card', 2048);
        $birth_certificate = $saveImage('birth_certificate', 2048);
        $image_educational_qualification = $saveImage('image_educational_qualification', 4096);
        $image_promissory_note = $saveImage('image_promissory_note', 4096);

        $data = [
            'user_id' => $userId,
            'card_number' => $this->card_number,
            'shaba_number' => $this->shaba_number,
            'face_image' => $face_image,
            'image_national_card' => $image_national_card,
            'birth_certificate' => $birth_certificate,
            'image_educational_qualification' => $image_educational_qualification,
            'image_promissory_note' => $image_promissory_note,
        ];

        if ($userData) {
            // آپدیت
            $userData->update($data);
            session()->flash('success', 'اطلاعات با موفقیت آپدیت شد.');
        } else {
            // ساخت رکورد جدید
            \App\Models\UserNationalityData::create($data);
            session()->flash('success', 'اطلاعات با موفقیت ذخیره شد.');
        }
    }
    public function render()
    {
        return view('frontend::livewire.client.items.profile.tab-two-profile-form');
    }
}
