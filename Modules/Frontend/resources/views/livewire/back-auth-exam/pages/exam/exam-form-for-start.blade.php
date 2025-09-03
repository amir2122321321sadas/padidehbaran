@section('head-tags')
    <title>{{ $title ?? 'Page Title' }}</title>
@endsection
<div class="min-h-screen flex items-center justify-center p-5 h-full">

    <x-frontend::backgroundloginregisterform/>
    <div class="w-full max-w-sm space-y-5" style="z-index: 2">
        <div class="bg-gradient-to-b from-secondary to-background rounded-3xl space-y-5 px-5 pb-5">
              <!-- عنوان آزمون -->

            <div class="bg-background rounded-b-3xl space-y-2 p-5">

                <a href="{{route('home')}}" wire:navigate class="inline-flex items-center gap-2 text-primary">
                    <x-frontend::logo/>
                    <span class="flex flex-col items-start">
                            <span class="font-semibold text-sm text-muted">آکــــادمـــی</span>
                            <x-frontend::nameweb/>
                        </span>
                </a>

                <div class="text-center mt-3">
                    <h1 class="text-2xl font-bold text-foreground">{{ $exam->title }}</h1>
                </div>
            </div>

                <!-- auth:verification:form -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1">
                                <div class="w-1 h-1 bg-foreground rounded-full"></div>
                                <div class="w-2 h-2 bg-foreground rounded-full"></div>
                            </div>
                            <div class="font-black text-foreground">شروع آزمون</div>
                        </div>

                    </div>

                    <div class="text-sm text-muted space-y-3">
                        <p>درود 👋</p>
                        <p>لطفا اطلاعات خود را وارد کنید</p>
                    </div>

                    <!-- form:field:wrapper: nationalCode -->
                    <div class="mb-3">
                        <label for="fullName" class="block mb-2 text-sm font-medium text-foreground">نام و نام خانوادگی</label>
                        <input
                            type="text"
                            id="fullName"
                            wire:model.change="fullName"
                            dir="ltr"
                            class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground placeholder:text-right px-5"
                            placeholder=" نام و نام خانوادگی خود را وارد کنید"
                        />
                        @error('fullName')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- end form:field:wrapper: nationalCode -->

                    <!-- form:field:wrapper: email -->
                    <div class="mb-3">
                        <label for="phone" class="block mb-2 text-sm font-medium text-foreground">شماره تماس</label>
                        <input
                            type="phone"
                            id="phone"
                            wire:model.change="phone"
                            dir="ltr"
                            class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground placeholder:text-right px-5"
                            placeholder="شماره تماس خود را وارد کنید"
                            maxlength="11"
                        />
                        @error('phone')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- end form:field:wrapper: email -->

                    <!-- form:field:wrapper: password -->
                    <div class="mb-3">
                          <label for="email" class="block mb-2 text-sm font-medium text-foreground">ایمیل (اختیاری)</label>
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
                    <!-- end form:field:wrapper: password -->

                    <!-- دکمه ذخیره -->
                    <!-- form:submit button -->
                    <button type="submit" wire:click="startExam" wire:loading.attr="disabled"
                            wire:target="startExam"
                            class="flex items-center justify-center gap-1 w-full h-10 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                        <span class="font-semibold text-sm">شروع آزمون</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="w-5 h-5" wire:loading.remove wire:target="startExam">
                            <path fill-rule="evenodd"
                                  d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <x-filament::loading-indicator class="h-5 w-5 text-white" wire:loading
                                                       wire:target="startExam"/>
                    </button>
                    <!-- end form:submit button -->


                </div>
                <!-- end auth:verification:form -->


        </div>

    </div>
</div>
