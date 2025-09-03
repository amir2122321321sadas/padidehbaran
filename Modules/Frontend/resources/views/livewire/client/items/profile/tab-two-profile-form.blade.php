@php use Illuminate\Support\Facades\Auth; @endphp
@php
    $userData = \App\Models\UserNationalityData::where('user_id' , Auth::id())->first()
@endphp
<div class="space-y-5" x-show="activeTab === 'tabTwo'">
    <div class="flex items-center gap-3">
        <div class="flex items-center gap-1">
            <div class="w-1 h-1 bg-foreground rounded-full"></div>
            <div class="w-2 h-2 bg-foreground rounded-full"></div>
        </div>
        <div class="font-black text-foreground">مدارک واطلاعات هویتی</div>
    </div>
    <!-- alert -->
    <div
        class="flex items-start gap-3 relative bg-zinc-50 dark:bg-zinc-900 border border-border rounded-xl p-5"
        x-show="open" x-data="{ open: true }">
        <!-- alert:icon -->
        <span class="text-blue-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                             fill="currentColor" class="w-5 h-5">
                                                            <path fill-rule="evenodd"
                                                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                                  clip-rule="evenodd"></path>
                                                        </svg>
                                                    </span><!-- alert:icon -->

        <!-- alert:content -->
        <div class="flex flex-col items-start">
            <!-- alert:title -->
            <div class="font-bold text-sm text-blue-500 mb-2">
                توجه :‌
            </div><!-- end alert:title -->

            <!-- alert:desc -->
            <div class="font-semibold text-xs text-zinc-400">
                <p class="mb-1 text-blue-500">
                    فقط شماره کارت و شماره شبای ملت مورد قبول میباشد،لطفا دقت بفرمایید.<br>
                </p>

            </div><!-- end alert:desc -->

            <!-- alert:actions -->
            <div class="flex flex-wrap items-center gap-3 mt-2">
                <button type="button"
                        class="flex items-center gap-x-1 text-zinc-400 underline-offset-1 hover:underline"
                        x-on:click="open = false">
                    <span class="font-bold text-xs">فهمیدم</span>
                </button>
            </div><!-- end alert:actions -->
        </div><!-- end alert:content -->
    </div><!-- end alert -->

    <div class="space-y-5">
        <div class="grid sm:grid-cols-2 gap-5">
            <div class="space-y-1">
                <label for="card_number" class="font-medium text-xs text-muted">
                    شماره کارت (فقط شماره کارت ملت)<span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="card_number"
                    wire:model.change="card_number" {{-- بهتره defer باشه برای اینکار --}}
                    class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"
                    oninput="formatCardNumber(this)"
                    maxlength="19" {{-- 16 رقم + 3 تا خط تیره --}}
                />
                @error('card_number')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <div class="font-medium text-xs text-red-500">
                    **فقط شماره کارت ملت ثبت گردد،درصورت وارد کردن شماره کارتی بغیراز ملت مسئولیت برعهده خودتان میباشد و
                    واریزی ها فقط به شماره کارت های ملت انجام میشود**
                </div>
            </div>

            <div class="space-y-1">
                <label for="shaba_number" class="font-medium text-xs text-muted">
                    شماره شبا (فقط شماره شبا ملت)
                    <span class="text-red-500">*</span></label>
                <input
                    type="text"
                    id="shaba_number"
                    maxlength="22"
                    wire:model.change="shaba_number"
                    class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"
                />
                @error('shaba_number')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
                <div class="font-medium text-xs text-red-500">
                    **فقط شماره شبا ملت ثبت گردد،درصورت وارد کردن شماره شبایی بغیراز ملت مسئولیت برعهده خودتان میباشد و
                    واریزی ها فقط به شماره شبا های ملت انجام میشود**
                </div>
            </div>


            <div class="space-y-1">
                <label for="face_image" class="font-medium text-xs text-muted">
                    تصویر پروفایل (اندازه:4*3)
                    <span class="text-red-500">*</span>
                </label>
                {{-- فیلد آپلود تصویر با استایل مشابه --}}
                <div
                    x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false"
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <input
                        type="file"
                        id="face_image"
                        wire:model.change="face_image"
                        accept="image/*"
                        class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5 py-2"
                    />
                    <div x-show="uploading">
                        <progress class="rounded-full" max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
                {{-- نمایش تصویر قبلی ثبت شده از storage --}}
                @if (!empty($userData->face_image))
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $userData->face_image) }}" alt="تصویر ثبت شده"
                             class="h-20 rounded-xl border border-border object-cover">
                    </div>
                @endif
                {{-- پیش نمایش تصویر جدید --}}
                @if ($face_image && (!isset($userData) || empty($userData->face_image) || $face_image != $userData->face_image))
                    <div class="mt-2">
                        <img src="{{ $face_image->temporaryUrl() }}" alt="پیش‌نمایش تصویر"
                             class="h-20 rounded-xl border border-border object-cover">
                    </div>
                @endif
                @error('face_image')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>


            <div class="space-y-1">
                <label for="image_national_card" class="font-medium text-xs text-muted">
                    تصویر کارت ملی
                    <span class="text-red-500">*</span>
                </label>
                {{-- فیلد آپلود تصویر با استایل مشابه --}}
                <div
                    x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false"
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <input
                        type="file"
                        id="image_national_card"
                        wire:model.change="image_national_card"
                        accept="image/*"
                        class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5 py-2"
                    />
                    <div x-show="uploading">
                        <progress class="rounded-full" max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
                {{-- نمایش تصویر قبلی ثبت شده از storage --}}
                @if (!empty($userData->image_national_card))
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $userData->image_national_card) }}" alt="تصویر ثبت شده"
                             class="h-20 rounded-xl border border-border object-cover">
                    </div>
                @endif
                @if ($image_national_card && (!isset($userData) || empty($userData->image_national_card) || $image_national_card != $userData->image_national_card))
                    <div class="mt-2">
                        <img
                            src="{{ is_object($image_national_card) ? $image_national_card->temporaryUrl() : asset('storage/' . $image_national_card) }}"
                            alt="پیش‌نمایش تصویر"
                            class="h-20 rounded-xl border border-border object-cover">
                    </div>
                @endif
                @error('image_national_card')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="birth_certificate" class="font-medium text-xs text-muted">
                    تصویر شناسنامه
                    <span class="text-red-500">*</span>
                </label>
                {{-- فیلد آپلود تصویر با استایل مشابه --}}
                <div
                    x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false"
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <input
                        type="file"
                        id="birth_certificate"
                        wire:model.change="birth_certificate"
                        accept="image/*"
                        class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5 py-2"
                    />
                    <div x-show="uploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
                {{-- نمایش تصویر قبلی ثبت شده از storage --}}
                @if (!empty($userData->birth_certificate))
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $userData->birth_certificate) }}" alt="تصویر ثبت شده"
                             class="h-20 rounded-xl border border-border object-cover">
                    </div>
                @endif
                @if ($birth_certificate && (!isset($userData) || empty($userData->birth_certificate) || $birth_certificate != $userData->birth_certificate))
                    <div class="mt-2">
                        <img
                            src="{{ is_object($birth_certificate) ? $birth_certificate->temporaryUrl() : asset('storage/' . $birth_certificate) }}"
                            alt="پیش‌نمایش تصویر"
                            class="h-20 rounded-xl border border-border object-cover">
                    </div>
                @endif
                @error('birth_certificate')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>


            <div class="space-y-1">
                <label for="image_educational_qualification" class="font-medium text-xs text-muted">
                    تصویر مدرک تحصیلی
                    <span class="text-red-500">*</span>
                </label>
                {{-- فیلد آپلود تصویر با استایل مشابه --}}
                <div
                    x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false"
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <input
                        type="file"
                        id="image_educational_qualification"
                        wire:model.change="image_educational_qualification"
                        accept="image/*"
                        class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5 py-2"
                    />
                    <div x-show="uploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
                {{-- نمایش تصویر قبلی ثبت شده از storage --}}
                @if (!empty($userData->image_educational_qualification))
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $userData->image_educational_qualification) }}"
                             alt="تصویر ثبت شده"
                             class="h-20 rounded-xl border border-border object-cover">
                    </div>
                @endif
                @php
                    $userImageEducationalQualification = $userData->image_educational_qualification ?? null;
                @endphp
                @if ($image_educational_qualification && (!$userImageEducationalQualification || $image_educational_qualification != $userImageEducationalQualification))
                    <div class="mt-2">
                        <img
                            src="{{ is_object($image_educational_qualification) ? $image_educational_qualification->temporaryUrl() : asset('storage/' . $image_educational_qualification) }}"
                            alt="پیش‌نمایش تصویر"
                            class="h-20 rounded-xl border border-border object-cover">
                    </div>
                @endif
                @error('image_educational_qualification')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>


            <div class="space-y-1">
                <label for="image_promissory_note" class="font-medium text-xs text-muted">
                    تصویر سفته (طبق مبلغ اعلامی)
                    <span class="text-red-500">*</span>
                </label>
                {{-- فیلد آپلود تصویر با استایل مشابه --}}
                <div
                    x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false"
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <input
                        type="file"
                        id="image_promissory_note"
                        wire:model.change="image_promissory_note"
                        accept="image/*"
                        class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5 py-2"
                    />
                    <div x-show="uploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>
                {{-- نمایش تصویر قبلی ثبت شده از storage --}}
                @if (!empty($userData->image_promissory_note))
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $userData->image_promissory_note) }}" alt="تصویر ثبت شده"
                             class="h-20 rounded-xl border border-border object-cover">
                    </div>
                @endif
                @php
                    $userPromissoryNote = $userData->image_promissory_note ?? null;
                @endphp
                @if ($image_promissory_note && (!$userPromissoryNote || $image_promissory_note != $userPromissoryNote))
                    <div class="mt-2">
                        <img
                            src="{{ is_object($image_promissory_note) ? $image_promissory_note->temporaryUrl() : asset('storage/' . $image_promissory_note) }}"
                            alt="پیش‌نمایش تصویر"
                            class="h-20 rounded-xl border border-border object-cover">
                    </div>
                @endif

                @error('image_promissory_note')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>


        </div>


    </div>


    <div class="flex justify-end gap-5">


        <div x-data="{ modalOpen: false }">

            <!-- دکمه ذخیره -->
            <!-- form:submit button -->
            <button type="submit" x-on:click="modalOpen = true" wire:target="saveOrUpdate" wire:loading.attr="disabled"
                    class="h-11 inline-flex items-center justify-center gap-3 bg-primary rounded-full text-white px-4 mr-auto">
                <span class="font-semibold text-sm">بروزرسانی</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" wire:loading.remove
                     wire:target="saveOrUpdate"
                     fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd"
                          d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z"
                          clip-rule="evenodd"></path>
                </svg>

                <x-filament::loading-indicator class="h-5 w-5 text-white" wire:loading wire:target="saveOrUpdate"/>

            </button>

            <!-- end form:submit button -->


            <!-- modal -->
            <div x-cloak x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen px-4">
                    <div x-show="modalOpen"
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                         x-transition:leave="transition ease-in duration-200 transform"
                         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                         class="relative w-full max-w-sm my-20 overflow-hidden bg-background border border-border rounded-2xl shadow-2xl z-20">

                        <!-- header -->
                        <div class="relative p-4">
                            <button class="absolute left-4 text-muted-foreground hover:text-error"
                                    x-on:click="modalOpen = false">
                                ✕
                            </button>
                        </div>

                        <!-- content -->
                        <div class="p-6 text-center">
                            <div
                                class="w-14 h-14 mx-auto flex items-center justify-center bg-blue-100 rounded-full text-blue-600 mb-4">
                                💾
                            </div>
                            <h3 class="font-bold text-foreground mb-2">آیا از صحت اطلاعات اطمینان دارید؟</h3>
                            <p class="font-bold  text-red-500 underline">
                                با دقت اطلاعات را بررسی بفرمایید (هرفیلد قرمزرنگ به معنی صحیح نبودن اطلاعات است):</p>
                            <br>
                            <p class="text-sm text-foreground @error('card_number') text-red-500 @enderror">شماره کارت
                                وارد شده (الزامی): <br>{{$card_number ?? 'وارد نشده است'}}</p>
                            @error('card_number')
                            <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                            @enderror

                            <p class="text-sm text-foreground @error('shaba_number') text-red-500 @enderror">شماره شبا
                                وارد شده (الزامی): {{$shaba_number ?? 'وارد نشده است'}}</p>
                            @error('shaba_number')
                            <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                            @enderror

                            <p class="text-sm text-foreground @error('face_image') text-red-500 @enderror">تصویر چهره
                                (الزامی):
                                @if(!empty($face_image) && !is_string($face_image))
                                    فایل انتخاب شده
                                @elseif(!empty($face_image))
                                    آپلود شده
                                @else
                                    وارد نشده است
                                @endif
                            </p>
                            @error('face_image')
                            <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                            @enderror

                            <p class="text-sm text-foreground @error('image_national_card') text-red-500 @enderror">
                                تصویر کارت ملی (الزامی):
                                @if(!empty($image_national_card) && !is_string($image_national_card))
                                    فایل انتخاب شده
                                @elseif(!empty($image_national_card))
                                    آپلود شده
                                @else
                                    وارد نشده است
                                @endif
                            </p>
                            @error('image_national_card')
                            <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                            @enderror

                            <p class="text-sm text-foreground @error('birth_certificate') text-red-500 @enderror">تصویر
                                شناسنامه (الزامی):
                                @if(!empty($birth_certificate) && !is_string($birth_certificate))
                                    فایل انتخاب شده
                                @elseif(!empty($birth_certificate))
                                    آپلود شده
                                @else
                                    وارد نشده است
                                @endif
                            </p>
                            @error('birth_certificate')
                            <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                            @enderror

                            <p class="text-sm text-foreground @error('image_educational_qualification') text-red-500 @enderror">
                                تصویر مدرک تحصیلی (الزامی):
                                @if(!empty($image_educational_qualification) && !is_string($image_educational_qualification))
                                    فایل انتخاب شده
                                @elseif(!empty($image_educational_qualification))
                                    آپلود شده
                                @else
                                    وارد نشده است
                                @endif
                            </p>
                            @error('image_educational_qualification')
                            <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                            @enderror

                            <p class="text-sm text-foreground @error('image_promissory_note') text-red-500 @enderror">
                                تصویر سفته (الزامی):
                                @if(!empty($image_promissory_note) && !is_string($image_promissory_note))
                                    فایل انتخاب شده
                                @elseif(!empty($image_promissory_note))
                                    آپلود شده
                                @else
                                    وارد نشده است
                                @endif
                            </p>
                            @error('image_promissory_note')
                            <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                            @enderror

                        </div>

                        <!-- footer -->
                        <div class="flex gap-x-4 border-t border-border p-4">
                            <button type="button"
                                    class="flex items-center justify-center gap-x-2 w-full bg-background border border-border rounded-xl text-foreground py-2 px-4"
                                    x-on:click="modalOpen = false">
                                لغو
                            </button>
                            <button
                                type="button"
                                class="flex items-center justify-center gap-x-2 w-full bg-primary border border-transparent rounded-xl text-error-foreground py-2 px-4 disabled:bg-gray-50 disabled:cursor-not-allowed"
                                x-on:click="$wire.saveOrUpdate(); modalOpen = false"
                                :disabled="@js($errors->isNotEmpty())"
                            >
                                بله، ذخیره شود
                            </button>

                        </div>
                    </div>

                    <!-- overlay -->
                    <div class="fixed inset-0 bg-secondary/80 cursor-pointer z-10"
                         x-on:click="modalOpen = false">
                    </div>
                </div>
            </div>
        </div>


        @if (session()->has('success'))
            <div
                class="mb-4 rounded-xl bg-green-100 border border-green-300 text-green-800 px-4 py-3 text-sm flex items-center gap-2">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                <span class="text-foreground">{{ session('success') }}</span>
            </div>
        @endif
    </div>

    <script>
        function formatCardNumber(input) {
            let value = input.value.replace(/\D/g, ''); // فقط اعداد
            let formatted = value.match(/.{1,4}/g);     // هر ۴ رقم جدا

            if (formatted) {
                input.value = formatted.join('-');      // جداکننده -
            } else {
                input.value = value;
            }
        }
    </script>
</div>

