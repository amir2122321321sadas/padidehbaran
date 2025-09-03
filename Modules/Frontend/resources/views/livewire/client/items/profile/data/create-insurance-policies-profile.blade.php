<div id="myForm">
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="grid sm:grid-cols-2 gap-5">
                <div class="space-y-1">
                    <label for="insurance_policies_number"
                           class="block font-semibold text-sm text-foreground">شماره بیمه نامه:<span
                            class="text-red-500">*</span></label>
                    <input type="text" name="insurance_policies_number" id="insurance_policies_number"
                           wire:model.change="insurance_policies_number"
                           maxlength="255"
                           class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                    @error('insurance_policies_number')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                    <div class="font-medium text-xs text-yellow-500">
                        **شماره بیمه نامه را با دقت وارد نمایید**
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="date_of_issue"
                           class="block font-semibold text-sm text-foreground">تاریخ صدوربیمه نامه:<span
                            class="text-red-500">*</span></label>
                    <input type="text" name="date_of_issue" id="date_of_issue"
                           wire:model.change="date_of_issue" data-jdp placeholder="تاریخ را انتخاب کنید"
                           maxlength="255"
                           class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                    @error('date_of_issue')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="type_insurance_policies"
                           class="block font-semibold text-sm text-foreground">نوع بیمه نامه:<span
                            class="text-red-500">*</span></label>

                    <select id="level" wire:model.change="type_insurance_policies"
                            class="form-select w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground px-5">
                        <option value="">انتخاب کنید</option>

                        @php
                            $user = auth()->user();
                            $hasActivePolicy = $user->insurancePolicies->where('status', 1)->count() > 0;
                            $typeOptions = \App\Models\InsurancePolicy::TYPE_INSURANCE_POLICIES;
                        @endphp

                        @if(!$hasActivePolicy)
                            <option value="0">{{ $typeOptions[0] }}</option>
                        @else
                            @foreach($typeOptions as $key => $option)
                                <option value="{{ $key }}">{{ $option }}</option>
                            @endforeach
                        @endif


                    </select>
                    @error('type_insurance_policies')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="installment_type"
                           class="block font-semibold text-sm text-foreground">نوع اقساط بیمه نامه:<span
                            class="text-red-500">*</span></label>

                    <select id="level" wire:model.change="installment_type"
                            class="form-select w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground px-5">
                        <option value="">انتخاب کنید</option>
                        @php
                            $typeOptions = \App\Models\InsurancePolicy::INSTALLMENT_TYPES;
                        @endphp

                        @foreach($typeOptions as $key => $option)
                            <option value="{{ $key }}">{{ $option }}</option>
                        @endforeach
                    </select>

                    @error('installment_type')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                    @enderror
                </div>


            </div>
            <div class="grid sm:grid-cols-1 gap-5" style="margin-top: 35px">
                @if($installment_type != null)
                    <div class="space-y-1">
                        <label for="amount_of_each_installment"
                               class="block font-semibold text-sm text-foreground">مبلغ هر قسط (ریال):<span
                                class="text-red-500">*</span></label>
                        <input type="text" name="amount_of_each_installment" id="amount_of_each_installment"
                               wire:model.change="amount_of_each_installment"
                               maxlength="255"
                               class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                        @error('amount_of_each_installment')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                        <div class="font-medium text-xs text-yellow-500">
                            **مبلغ هر قسط را با دقت وارد نمایید**
                        </div>
                    </div>
                @endif

                <div class="space-y-1">
                    <label for="images"
                           class="block font-semibold text-sm text-foreground">تصاویر بیمه نامه:<span
                            class="text-red-500">*</span></label>
                    <div
                        x-data="{ uploading: false, progress: 0 }"
                        x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false"
                        x-on:livewire-upload-cancel="uploading = false"
                        x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                    >
                        <input type="file" name="images" id="images" wire:model.change="images" multiple
                               class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                        @error('images')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                        @if (!empty($images))
                            <div class="mt-2 flex flex-row gap-2">
                                @foreach ($images as $image)
                                    @if (is_object($image))

                                        <img src="{{ $image->temporaryUrl() }}" alt="پیش‌نمایش تصویر"
                                             class="h-20 rounded-xl border border-border object-cover">
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        <!-- Progress Bar -->
                        <div x-show="uploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                        @error('images')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                        <div class="font-medium text-xs text-gray-500 mt-2">
                            می‌توانید چند تصویر را انتخاب کنید. (فرمت‌های مجاز: jpg, png, jpeg)
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">


        <div x-data="{ modalOpen: false }">

            <!-- دکمه ذخیره -->
            <!-- form:submit button -->
            <button x-on:click="modalOpen = true"
                    class="inline-flex items-center justify-center gap-x-1.5 h-10 bg-primary rounded-full text-primary-foreground transition-colors hover:bg-foreground hover:text-background px-6 ms-auto">
                <span class="font-semibold text-xs">ایجاد بیمه نامه</span>
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" wire:loading.remove
                     wire:target="save"
                     class="size-4">
                    <path
                        d="M20.5 16.75H18.25V14.5C18.25 14.09 17.91 13.75 17.5 13.75C17.09 13.75 16.75 14.09 16.75 14.5V16.75H14.5C14.09 16.75 13.75 17.09 13.75 17.5C13.75 17.91 14.09 18.25 14.5 18.25H16.75V20.5C16.75 20.91 17.09 21.25 17.5 21.25C17.91 21.25 18.25 20.91 18.25 20.5V18.25H20.5C20.91 18.25 21.25 17.91 21.25 17.5C21.25 17.09 20.91 16.75 20.5 16.75Z"
                        fill="currentColor"></path>
                    <path
                        d="M22 8.52V3.98C22 2.57 21.36 2 19.77 2H15.73C14.14 2 13.5 2.57 13.5 3.98V8.51C13.5 9.93 14.14 10.49 15.73 10.49H19.77C21.36 10.5 22 9.93 22 8.52Z"
                        fill="currentColor" opacity="0.4"></path>
                    <path
                        d="M10.5 8.52V3.98C10.5 2.57 9.86 2 8.27 2H4.23C2.64 2 2 2.57 2 3.98V8.51C2 9.93 2.64 10.49 4.23 10.49H8.27C9.86 10.5 10.5 9.93 10.5 8.52Z"
                        fill="currentColor"></path>
                    <path opacity="0.4"
                          d="M10.5 19.77V15.73C10.5 14.14 9.86 13.5 8.27 13.5H4.23C2.64 13.5 2 14.14 2 15.73V19.77C2 21.36 2.64 22 4.23 22H8.27C9.86 22 10.5 21.36 10.5 19.77Z"
                          fill="currentColor"></path>
                </svg>

                <x-filament::loading-indicator class="h-5 w-5 text-white" wire:loading wire:target="save"/>

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
                            <p class="text-sm text-foreground @error('insurance_policies_number') text-red-500 @enderror">
                                شماره بیمه نامه وارد شده (الزامی): <br>
                                {{$insurance_policies_number ?? 'وارد نشده است'}}
                            </p>
                            @error('insurance_policies_number')
                            <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                            @enderror

                            <p class="text-sm text-foreground @error('date_of_issue') text-red-500 @enderror">
                                تاریخ صدور بیمه نامه (الزامی): <br>
                                {{$date_of_issue ?? 'وارد نشده است'}}
                            </p>
                            @error('date_of_issue')
                            <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                            @enderror

                            <p class="text-sm text-foreground @error('type_insurance_policies') text-red-500 @enderror">
                                نوع بیمه نامه (الزامی): <br>
                                @if(isset($type_insurance_policies) && \App\Models\InsurancePolicy::TYPE_INSURANCE_POLICIES[$type_insurance_policies] ?? false)
                                    {{ \App\Models\InsurancePolicy::TYPE_INSURANCE_POLICIES[$type_insurance_policies] }}
                                @else
                                    وارد نشده است
                                @endif
                            </p>
                            @error('type_insurance_policies')
                            <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                            @enderror

                            <p class="text-sm text-foreground @error('images.*') text-red-500 @enderror">
                                تصاویر بیمه نامه (الزامی):
                                @if(!empty($images) && is_array($images) && count($images) > 0)
                                    {{ count($images) }} فایل انتخاب شده
                                @else
                                    وارد نشده است
                                @endif
                            </p>
                            @error('images.*')
                            <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                            @enderror

                            <p class="text-sm text-foreground @error('installment_type') text-red-500 @enderror">
                                نوع قسط (الزامی): <br>
                                @if(isset($installment_type) && \App\Models\InsurancePolicy::INSTALLMENT_TYPES[$installment_type] ?? false)
                                    {{ \App\Models\InsurancePolicy::INSTALLMENT_TYPES[$installment_type] }}
                                @else
                                    وارد نشده است
                                @endif
                            </p>
                            @error('installment_type')
                            <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                            @enderror

                            <p class="text-sm text-foreground @error('amount_of_each_installment') text-red-500 @enderror">
                                مبلغ هر قسط (الزامی): <br>
                                {{$amount_of_each_installment ?? 'وارد نشده است'}}
                            </p>
                            @error('amount_of_each_installment')
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
                                x-on:click="$wire.save(); modalOpen = false"
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
</div>
