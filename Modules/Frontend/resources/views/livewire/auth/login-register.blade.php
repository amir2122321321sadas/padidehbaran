@section('head-tags')
    <title>{{ $title ?? 'Page Title' }}</title>
@endsection
<div class="min-h-screen flex items-center justify-center p-5 h-full">
    <x-frontend::backgroundloginregisterform/>
    <div class="w-full max-w-sm space-y-5" style="z-index: 2">
        <div class="bg-gradient-to-b from-secondary to-background rounded-3xl space-y-5 px-5 pb-5">
            <div class="bg-background rounded-b-3xl space-y-2 p-5">
                <a href="{{route('home')}}" wire:navigate class="inline-flex items-center gap-2 text-primary">
                    <x-frontend::logo/>
                    <span class="flex flex-col items-start">
                            <span class="font-semibold text-sm text-muted">آکــــادمـــی</span>
                            <x-frontend::nameweb/>
                        </span>
                </a>
            </div>


            @if($registerForm)
                <!-- auth:verification:form -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1">
                                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                <div class="w-2 h-2 bg-foreground rounded-full"></div>
                            </div>
                            <div class="font-black text-foreground">ثبت نام</div>
                        </div>
                        <a wire:click="enableLoginForm" wire:loading.attr="disabled" wire:target="enableLoginForm"
                           class="cursor-pointer flex items-center gap-1 text-lg text-primary hover:text-primary/80 transition-colors hover:underline">
                            ورود
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" wire:target="enableLoginForm" wire:loading.remove>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7"/>
                            </svg>
                            <x-filament::loading-indicator class="h-5 w-5 text-primary" wire:loading
                                                           wire:target="enableLoginForm"/>

                        </a>

                    </div>

                    <div class="text-sm text-muted space-y-3">
                        <p>درود 👋</p>
                        <p>لطفا اطلاعات خود را وارد کنید</p>
                    </div>

                    <!-- form:field:wrapper: nationalCode -->
                    <div class="mb-3">
                        <label for="nationalCode" class="block mb-2 text-sm font-medium text-foreground">کد ملی</label>
                        <input
                            type="text"
                            id="nationalCode"
                            wire:model.change="national_code"
                            dir="ltr"
                            class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground placeholder:text-right px-5"
                            placeholder="کد ملی خود را وارد کنید"
                        />
                        @error('national_code')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- end form:field:wrapper: nationalCode -->

                    <!-- form:field:wrapper: email -->
                    <div class="mb-3">
                        <label for="email" class="block mb-2 text-sm font-medium text-foreground">ایمیل</label>
                        <input
                            type="email"
                            id="email"
                            wire:model.change="email"
                            dir="ltr"
                            class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground placeholder:text-right px-5"
                            placeholder="ایمیل خود را وارد کنید"
                        />
                        @error('email')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- end form:field:wrapper: email -->

                    <!-- form:field:wrapper: password -->
                    <div class="mb-3">
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="text-sm font-medium text-foreground">رمز عبور</label>
                            <span wire:click="enableforgotForm"
                                  class="text-xs text-primary cursor-pointer hover:underline">رمز خود را فراموش کردید؟</span>
                        </div>
                        <input
                            type="password"
                            id="password"
                            wire:model.change="password"
                            dir="ltr"
                            class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground placeholder:text-right px-5"
                            placeholder="رمز عبور خود را وارد کنید"
                        />
                        @error('password')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- end form:field:wrapper: password -->

                    <!-- form:field:wrapper: IdentificationCode -->
                    <div class="mb-3">
                        <label for="IdentificationCode" class="block mb-2 text-sm font-medium text-foreground">کد
                            معرف</label>
                        <input
                            type="text"
                            id="IdentificationCode"
                            wire:model.change="identification_code"
                            dir="ltr"
                            class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground placeholder:text-right px-5"
                            placeholder="کد معرف خود را وارد کنید"
                        />
                        @error('identification_code')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror

                        @if($identification_code)
                            <div class="font-medium text-xs text-blue-500 mt-1.5">
                                @php
                                    $user_identification_code = \App\Models\User::where('identification_code' , $identification_code)->first() ?? null;
                                @endphp
                                @if(!empty($user_identification_code->userInformation))
                                    نام و نام خانوادگی معرف:  {{$user_identification_code->userInformation->first_name . ' ' . $user_identification_code->userInformation->last_name}}
                                @endif
                            </div>
                        @endif

                    </div>
                    <!-- end form:field:wrapper: IdentificationCode -->


                    <div x-data="{ modalOpen: false }">

                        <!-- دکمه ذخیره -->
                        <!-- form:submit button -->
                        <button type="submit" x-on:click="modalOpen = true" wire:loading.attr="disabled"
                                wire:target="register"
                                class="flex items-center justify-center gap-1 w-full h-10 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                            <span class="font-semibold text-sm">ثبت نام</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="w-5 h-5" wire:loading.remove wire:target="register">
                                <path fill-rule="evenodd"
                                      d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <x-filament::loading-indicator class="h-5 w-5 text-white" wire:loading
                                                           wire:target="register"/>
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
                                        <h3 class="font-bold text-foreground mb-2">آیا از صحت اطلاعات اطمینان
                                            دارید؟</h3>
                                        <p class="font-bold  text-red-500 underline">**بعد از ذخیره امکان بازگشت وجود
                                            ندارد.**<br>
                                            با دقت اطلاعات را بررسی بفرمایید (هرفیلد قرمزرنگ به معنی صحیح نبودن اطلاعات
                                            است):</p>
                                        <br>
                                        <p class="text-sm text-foreground @error('national_code') text-red-500 @enderror">
                                            کد ملی وارد شده(الزامی):{{$national_code ?? 'وارد نشده است'}}</p>
                                        @error('national_code')
                                        <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                                        @enderror

                                        <p class="text-sm text-foreground @error('email') text-red-500 @enderror">ایمیل
                                            وارد شده(الزامی):{{$email ?? 'وارد نشده است'}}</p>
                                        @error('email')
                                        <span class="text-xs text-red-500 border-b border-border">{{ $message }}</span>
                                        @enderror

                                        <p class="text-sm text-foreground @error('password') text-red-500 @enderror">
                                            رمزعبور وارد شده(الزامی):{{$password ?? 'وارد نشده است'}}</p>
                                        @error('password')
                                        <span class="text-xs text-red-500  border-b border-border">{{ $message }}</span>
                                        @enderror

                                        <p class="text-sm text-foreground @error('identification_code') text-red-500 @enderror">

                                            کد معرف وارد شده(الزامی):{{$identification_code ?? 'وارد نشده است'}}</p>
                                        @if($identification_code)
                                            <div class="font-medium text-xs text-blue-500 mt-1.5">
                                                @php
                                                    $user_identification_code = \App\Models\User::where('identification_code' , $identification_code)->first() ?? null;
                                                @endphp
                                                @if(!empty($user_identification_code->userInformation))
                                                    نام و نام خانوادگی معرف:  {{$user_identification_code->userInformation->first_name . ' ' . $user_identification_code->userInformation->last_name}}
                                                @endif                                            </div>
                                        @endif
                                        @error('identification_code')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
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
                                            x-on:click="$wire.register(); modalOpen = false"
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


                </div>
                <!-- end auth:verification:form -->
            @elseif($loginForm)
                <!-- auth:verification:form -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1">
                                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                <div class="w-2 h-2 bg-foreground rounded-full"></div>
                            </div>
                            <div class="font-black text-foreground">ورود</div>
                        </div>
                        <a wire:click="enableRegisterForm" wire:loading.attr="disabled" wire:target="enableRegisterForm"
                           class="cursor-pointer flex items-center gap-1 text-lg text-primary hover:text-primary/80 transition-colors hover:underline">
                            ثبت نام
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" wire:target="enableRegisterForm" wire:loading.remove>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7"/>
                            </svg>

                            <x-filament::loading-indicator class="h-5 w-5 text-primary" wire:target="enableRegisterForm"
                                                           wire:loading/>

                        </a>
                    </div>

                    <div class="text-sm text-muted space-y-3">
                        <p>درود 👋</p>
                        <p>لطفا اطلاعات خود را وارد کنید</p>
                    </div>

                    <!-- form:field:wrapper: nationalCode -->
                    <div class="mb-3">
                        <label for="nationalCode" class="block mb-2 text-sm font-medium text-foreground">کد ملی</label>
                        <input
                            type="text"
                            id="nationalCode"
                            wire:model.change="national_code"
                            dir="ltr"
                            class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground placeholder:text-right px-5"
                            placeholder="کد ملی خود را وارد کنید"
                        />
                        @error('national_code')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- end form:field:wrapper: nationalCode -->

                    <!-- form:field:wrapper: password -->
                    <div class="mb-3">
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="text-sm font-medium text-foreground">رمز عبور</label>
                            <span wire:click="enableforgotForm"
                                  class="text-xs text-primary cursor-pointer hover:underline">رمز خود را فراموش کردید؟</span>
                        </div>
                        <input
                            type="password"
                            id="password"
                            wire:model.change="password"
                            dir="ltr"
                            class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground placeholder:text-right px-5"
                            placeholder="رمز عبور خود را وارد کنید"
                        />
                        @error('password')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- end form:field:wrapper: password -->

                    <!-- form:submit button -->
                    <button type="submit" wire:click="login" wire:loading.attr="disabled" wire:target="login"
                            class="flex items-center justify-center gap-1 w-full h-10 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                        <span class="font-semibold text-sm">ورود</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"
                             wire:loading.remove wire:target="login">
                            <path fill-rule="evenodd"
                                  d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <x-filament::loading-indicator class="h-5 w-5 text-white" wire:loading wire:target="login"/>
                    </button>
                    <!-- end form:submit button -->


                </div>
                <!-- end auth:verification:form -->
            @elseif($forgotForm)
                <!-- auth:verification:form -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1">
                                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                <div class="w-2 h-2 bg-foreground rounded-full"></div>
                            </div>
                            <div class="font-black text-foreground">بازیابی رمزعبور</div>
                        </div>
                        <a wire:click="enableRegisterForm" wire:loading.attr="disabled" wire:target="enableRegisterForm"
                           class="cursor-pointer flex items-center gap-1 text-lg text-primary hover:text-primary/80 transition-colors hover:underline">
                            ثبت نام
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" wire:target="enableRegisterForm" wire:loading.remove>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 19l-7-7 7-7"/>
                            </svg>

                            <x-filament::loading-indicator class="h-5 w-5 text-primary" wire:target="enableRegisterForm"
                                                           wire:loading/>

                        </a>
                    </div>

                    <div class="text-sm text-muted space-y-3">
                        <p>درود 👋</p>
                        <p>لطفاکد ملی یا ایمیل خود را وارد کنید</p>
                    </div>

                    <!-- form:field:wrapper: nationalCode -->
                    <div class="mb-3">
                        <label for="forgot" class="block mb-2 text-sm font-medium text-foreground">کد ملی(یا
                            ایمیل)</label>
                        <input
                            type="text"
                            id="forgot"
                            wire:model.change="forgot_field_input"
                            dir="ltr"
                            class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground placeholder:text-right px-5"
                            placeholder="کد ملی یا ایمیل خود را وارد کنید"
                        />
                        @error('forgot_field_input')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- end form:field:wrapper: nationalCode -->


                    <!-- form:submit button -->
                    <button type="submit" wire:click="forgot" wire:loading.attr="disabled" wire:target="forgot"
                            class="flex items-center justify-center gap-1 w-full h-10 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                        <span class="font-semibold text-sm">ادامه</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"
                             wire:loading.remove wire:target="forgot">
                            <path fill-rule="evenodd"
                                  d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <x-filament::loading-indicator class="h-5 w-5 text-white" wire:loading wire:target="forgot"/>
                    </button>
                    <!-- end form:submit button -->


                </div>
                <!-- end auth:verification:form -->
            @elseif($verifyCodeForgotPassword)
                <!-- auth:verification:form -->
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1">
                            <div class="w-1 h-1 bg-foreground rounded-full"></div>
                            <div class="w-2 h-2 bg-foreground rounded-full"></div>
                        </div>
                        <div class="font-black text-foreground">کد تایید را وارد کنید</div>
                    </div>
                    <div class="text-sm text-muted space-y-3">
                        <p>کد تایید برای ایمیل <span
                                dir="ltr">{{\App\Models\User::where('id' , session('password_reset_user_id'))->first()->email}}</span>
                            پیامک شد</p>
                    </div>

                    <!-- form:field:wrapper -->
                    <div class="flex flex-col relative space-y-1">
                        <input type="text" inputmode="numeric" dir="ltr"
                               wire:model.change="verify_code_forgot_password"
                               class="form-input w-full h-11 peer !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border invalid:!border-error rounded-xl text-lg tracking-9 text-center text-foreground invalid:!text-error placeholder:text-right px-5"
                               pattern="[0-9]+" maxlength="6"/>

                        @error('verify_code_forgot_password')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                        <!-- form:field:error message -->
                        <span class="hidden peer-invalid:block font-semibold text-xs text-error mt-2">
                            مقدار وارد شده باید فقط شامل عدد باشد.
                        </span>
                        <!-- end form:field:error message -->
                    </div>
                    <!-- end form:field:wrapper -->

                    <!-- form:submit button -->
                    <button type="submit" wire:click="verifyCodeForgot" wire:loading.attr="disabled"
                            wire:target="verifyCodeForgot"
                            class="flex items-center justify-center gap-1 w-full h-10 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                        <span class="font-semibold text-sm">تایید</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"
                             wire:target="verifyCodeForgot" wire:loading.remove>
                            <path fill-rule="evenodd"
                                  d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <x-filament::loading-indicator class="h-5 w-5 text-white" wire:loading
                                                       wire:target="verifyCodeForgot"/>
                    </button>
                    <!-- end form:submit button -->
                </div>
                <!-- auth:verification:form -->
            @elseif($resetPasswordForm)
                <!-- auth:verification:form -->
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1">
                            <div class="w-1 h-1 bg-foreground rounded-full"></div>
                            <div class="w-2 h-2 bg-foreground rounded-full"></div>
                        </div>
                        <div class="font-black text-foreground">تغییر رمز عبور</div>
                    </div>
                    <div class="text-sm text-muted space-y-3">
                        <p>کاربر با ایمیل: <span
                                dir="ltr">{{\App\Models\User::where('id' , session('password_reset_user_id'))->first()->email}}</span>
                            درحال تغییر رمز عبور است!</p>
                    </div>

                    <!-- form:field:wrapper -->
                    <div class="flex flex-col relative space-y-1">

                        <label for="newPassword" class="block mb-2 text-sm font-medium text-foreground">رمزعبور
                            جدید</label>

                        <input type="text" inputmode="numeric" dir="ltr" id="newPassword"
                               wire:model.change="newPassword"
                               class="form-input w-full h-11 peer !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border invalid:!border-error rounded-xl text-lg tracking-9 text-center text-foreground invalid:!text-error placeholder:text-right px-5"
                               minlength="6"/>

                        @error('newPassword')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                        <!-- form:field:error message -->
                        <span class="hidden peer-invalid:block font-semibold text-xs text-error mt-2">
                            حداقل 6 کاراکتر باید وارد شود.
                        </span>
                        <!-- end form:field:error message -->
                    </div>
                    <!-- end form:field:wrapper -->

                    <!-- form:field:wrapper -->
                    <div class="flex flex-col relative space-y-1">

                        <label for="conformNewPassword" class="block mb-2 text-sm font-medium text-foreground">تکرار
                            رمزعبور جدید</label>

                        <input type="text" inputmode="numeric" dir="ltr" id="conformNewPassword"
                               wire:model.change="conformNewPassword"
                               class="form-input w-full h-11 peer !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border invalid:!border-error rounded-xl text-lg tracking-9 text-center text-foreground invalid:!text-error placeholder:text-right px-5"
                               minlength="6"/>

                        @error('conformNewPassword')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                        <!-- form:field:error message -->
                        <span class="hidden peer-invalid:block font-semibold text-xs text-error mt-2">
                            حداقل 6 کاراکتر باید وارد شود.
                        </span>
                        <!-- end form:field:error message -->
                    </div>
                    <!-- end form:field:wrapper -->

                    <!-- form:submit button -->
                    <button type="submit" wire:click="changePassword" wire:loading.attr="disabled"
                            wire:target="changePassword"
                            class="flex items-center justify-center gap-1 w-full h-10 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                        <span class="font-semibold text-sm">تایید</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5"
                             wire:target="changePassword" wire:loading.remove>
                            <path fill-rule="evenodd"
                                  d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <x-filament::loading-indicator class="h-5 w-5 text-white" wire:loading
                                                       wire:target="changePassword"/>
                    </button>
                    <!-- end form:submit button -->
                </div>
                <!-- auth:verification:form -->
            @endif

        </div>
        <div class="bg-secondary rounded-xl space-y-5 p-5">
            <div class="font-medium text-xs text-center text-muted">
                ورود شما به معنای پذیرش <a href="{{route('terms')}}"
                                           class="text-foreground transition-colors hover:text-primary hover:underline">شرایط</a>
                و
                <a href="{{route('terms')}}" class="text-foreground transition-colors hover:text-primary hover:underline">قوانین
                    حریم خصوصی</a> است.
            </div>
        </div>



        <div class="bg-secondary rounded-xl space-y-5 p-5">
            <div class="font-medium text-xs text-center text-muted">
                <!-- form:submit button -->
                <a href="{{route('exam.list')}}"
                        class="cursor-pointer flex items-center justify-center gap-1 w-full h-10 bg-green-500 rounded-xl text-primary-foreground transition-all hover:opacity-80 px-4">
                    <span class="font-semibold text-sm">لیست آزمون ها</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                              d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                              clip-rule="evenodd"></path>
                    </svg>

                </a>
            </div>
        </div>
    </div>
</div>
