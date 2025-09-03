<div class="space-y-5" x-show="activeTab === 'tabOne'">
    <div class="flex items-center gap-3">
        <div class="flex items-center gap-1">
            <div class="w-1 h-1 bg-foreground rounded-full"></div>
            <div class="w-2 h-2 bg-foreground rounded-full"></div>
        </div>
        <div class="font-black text-foreground">اطلاعات حساب</div>
    </div>

    <div class="space-y-5">
        <div class="grid sm:grid-cols-2 gap-5">
            <div class="space-y-1">
                <label for="first_name" class="font-medium text-xs text-muted">نام (فارسی)<span
                        class="text-red-500">*</span></label>
                <input type="text" id="first_name" wire:model.change="first_name"
                       class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                @error('first_name')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="last_name" class="font-medium text-xs text-muted">نام خانوادگی
                    (فارسی)<span class="text-red-500">*</span></label>
                <input type="text" id="last_name" wire:model.change="last_name"
                       class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                @error('last_name')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="space-y-1">
                <label for="father_name" class="font-medium text-xs text-muted">نام پدر
                    (فارسی)<span class="text-red-500">*</span></label>
                <input type="text" id="father_name" wire:model.change="father_name"
                       class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                @error('father_name')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="national_code" class="font-medium text-xs text-muted">کدملی<span
                        class="text-red-500">*</span></label>
                <input type="text" id="national_code" wire:model="national_code" disabled
                       class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                <div class="font-medium text-xs text-muted">
                    کد ملی قابل تغییر نمیباشد.
                </div>
            </div>

            <div class="space-y-1">
                <label for="birth_certificate_number" class="font-medium text-xs text-muted">شماره
                    شناسنامه<span class="text-red-500">*</span></label>
                <input type="text" id="birth_certificate_number" wire:model.change="birth_certificate_number" {{--{{Auth::user()->userInformation->birth_certificate_number ? 'disabled' : ''}}--}}
                class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                @error('birth_certificate_number')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
{{--                @if(Auth::user()->userInformation->birth_certificate_number)--}}
{{--                    <div class="font-medium text-xs text-muted">--}}
{{--                        شماره شناسنامه شما قابل تغییر نمیباشد.--}}
{{--                    </div>--}}
{{--                @endif--}}
                <div class="font-medium text-xs text-red-500">
                    **اگر تاریخ تولد شما قبل از سال  1368 است شماره شناسنامه متفاوتی خواهید داشت در غیراینصورت کد ملی خود را وارد نمایید.**
                </div>

            </div>

            <div class="space-y-1">
                <label for="date_of_birth" class="font-medium text-xs text-muted">تاریخ تولد<span
                        class="text-red-500">*</span></label>
                <input id="date_of_birth" wire:model.change="date_of_birth" data-jdp
                       class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                @error('date_of_birth')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="flex items-center gap-3">
            <div class="flex items-center gap-1">
                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                <div class="w-2 h-2 bg-foreground rounded-full"></div>
            </div>
            <div class="font-black text-foreground">اطلاعات تماس،آدرس</div>
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            <div class="space-y-1">
                <label for="phone" class="font-medium text-xs text-muted">شماره موبایل<span
                        class="text-red-500">*</span></label>
                <input type="text" id="phone" wire:model.change="phone"
                       class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                @error('phone')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="postal_code" class="font-medium text-xs text-muted">کد پستی<span
                        class="text-red-500">*</span></label>
                <input type="text" id="postal_code" wire:model.change="postal_code"
                       class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                @error('postal_code')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-1">
                <label for="address" class="font-medium text-xs text-muted">آدرس<span
                        class="text-red-500">*</span></label>
                <textarea rows="5" id="address" wire:model.change="address"
                          class="form-textarea w-full !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"></textarea>
                @error('address')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="space-y-5" x-show="activeTab === 'tabOne'">
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1">
                    <div class="w-1 h-1 bg-foreground rounded-full"></div>
                    <div class="w-2 h-2 bg-foreground rounded-full"></div>
                </div>
                <div class="font-black text-foreground">معرف</div>
            </div>
            <div class="space-y-1">
                <label for="identification_code" class="font-medium text-xs text-muted">کد معرف<span
                        class="text-red-500">*</span></label>
                <input type="text" id="identification_code" disabled  wire:model.change="identification_code" data-disabled
                       class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                <div class="font-medium text-xs text-muted">
                    کد معرف قابل تغییر نمیباشد.
                </div>
            </div>

        </div>






        <div class="flex justify-end gap-5">


            <div x-data="{ modalOpen: false }">

                <!-- دکمه ذخیره -->
                <!-- form:submit button -->
                <button x-on:click="modalOpen = true" wire:loading.attr="disabled"
                        class="h-11 inline-flex items-center justify-center gap-3 bg-primary rounded-full text-white px-4 mr-auto">
                    <span class="font-semibold text-sm">بروزرسانی</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" wire:loading.remove wire:target="saveProfile"
                         fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                              d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z"
                              clip-rule="evenodd"></path>
                    </svg>

                    <x-filament::loading-indicator class="h-5 w-5 text-white" wire:loading wire:target="saveProfile"/>

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
                                <div class="w-14 h-14 mx-auto flex items-center justify-center bg-blue-100 rounded-full text-blue-600 mb-4">
                                    💾
                                </div>
                                <h3 class="font-bold text-foreground mb-2">آیا از صحت اطلاعات اطمینان دارید؟</h3>
                                <p class="font-bold  text-red-500 underline">
                                    با دقت اطلاعات را بررسی بفرمایید (هرفیلد قرمزرنگ به معنی صحیح نبودن اطلاعات است):</p>
                                <br>
                                <p class="text-sm text-foreground @error('first_name') text-red-500 @enderror">نام وارد شده (الزامی): {{$first_name ?? 'وارد نشده است'}}</p>
                                @error('first_name')
                                <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                                @enderror

                                <p class="text-sm text-foreground @error('last_name') text-red-500 @enderror">نام خانوادگی وارد شده (الزامی): {{$last_name ?? 'وارد نشده است'}}</p>
                                @error('last_name')
                                <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                                @enderror

                                <p class="text-sm text-foreground @error('father_name') text-red-500 @enderror">نام پدر وارد شده (الزامی): {{$father_name ?? 'وارد نشده است'}}</p>
                                @error('father_name')
                                <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                                @enderror

                                <p class="text-sm text-foreground @error('national_code') text-red-500 @enderror">کد ملی وارد شده (الزامی): {{$national_code ?? 'وارد نشده است'}}</p>
                                @error('national_code')
                                <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                                @enderror

                                <p class="text-sm text-foreground @error('birth_certificate_number') text-red-500 @enderror">شماره شناسنامه وارد شده (الزامی): {{$birth_certificate_number ?? 'وارد نشده است'}}</p>
                                @error('birth_certificate_number')
                                <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                                @enderror

                                <p class="text-sm text-foreground @error('date_of_birth') text-red-500 @enderror">تاریخ تولد وارد شده (الزامی): {{$date_of_birth ?? 'وارد نشده است'}}</p>
                                @error('date_of_birth')
                                <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                                @enderror

                                <p class="text-sm text-foreground @error('phone') text-red-500 @enderror">شماره موبایل وارد شده (الزامی): {{$phone ?? 'وارد نشده است'}}</p>
                                @error('phone')
                                <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                                @enderror

                                <p class="text-sm text-foreground @error('postal_code') text-red-500 @enderror">کد پستی وارد شده (الزامی): {{$postal_code ?? 'وارد نشده است'}}</p>
                                @error('postal_code')
                                <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                                @enderror

                                <p class="text-sm text-foreground @error('address') text-red-500 @enderror">آدرس وارد شده (الزامی): {{$address ?? 'وارد نشده است'}}</p>
                                @error('address')
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
                                    x-on:click="$wire.saveProfile(); modalOpen = false"
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
                <div class="mb-4 rounded-xl bg-green-100 border border-green-300 text-green-800 px-4 py-3 text-sm flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="text-foreground">{{ session('success') }}</span>
                </div>
            @endif
        </div>
    </div>
</div>
