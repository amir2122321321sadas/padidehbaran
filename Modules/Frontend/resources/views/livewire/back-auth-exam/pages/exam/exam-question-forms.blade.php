<div class="min-h-screen block items-center justify-center p-6">
    <header class="relative py-5 z-30" x-data="{ offcanvasOpen: false }">



        <div class="max-w-7xl relative px-4 mx-auto">
            <div class="bg-secondary rounded-3xl py-3 px-5">
                <div class="flex items-center gap-8 h-20">
                    <div class="flex items-center gap-3">
                        <button type="button"
                                class="lg:hidden inline-flex items-center justify-center relative w-10 h-10 bg-background rounded-full text-foreground"
                                x-on:click="offcanvasOpen = true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                            </svg>
                        </button>
                        <a href="{{route('home')}}" class="inline-flex items-center gap-2 text-primary">
                            <x-frontend::logo/>
                            <span class="flex flex-col items-start">
                                    <span class="font-semibold text-sm text-muted">آکــــادمـــی</span>
                                    <x-frontend::name-web/>
                                </span>
                        </a>
                    </div>

                    <div class="flex items-center md:gap-5 gap-3 mr-auto">
                        <button type="button"
                                class="hidden lg:inline-flex items-center justify-center w-10 h-10 bg-background rounded-full text-foreground"
                                id="dark-mode-button">
                                <span class="light-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z"/>
                                    </svg>
                                </span>
                            <span class="dark-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"/>
                                    </svg>
                                </span>
                        </button>


                        <!-- <a href="./login-register.html"
                    class="inline-flex items-center justify-center gap-1 h-10 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3 3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75 0 0 1 15 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6Zm5.03 4.72a.75.75 0 0 1 0 1.06l-1.72 1.72h10.94a.75.75 0 0 1 0 1.5H10.81l1.72 1.72a.75.75 0 1 1-1.06 1.06l-3-3a.75.75 0 0 1 0-1.06l3-3a.75.75 0 0 1 1.06 0Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-semibold text-sm">حساب کاربری</span>
                </a> -->
                    </div>
                </div>
            </div>



        </div>

        <!-- offcanvas -->
        <div x-cloak>
            <!-- offcanvas:box -->
            <div
                class="fixed inset-y-0 right-0 xs:w-80 w-72 h-screen bg-background rounded-l-2xl overflow-y-auto transition-transform z-50"
                x-bind:class="offcanvasOpen ? '!translate-x-0' : 'rtl:translate-x-full ltr:-translate-x-full'">
                <!-- offcanvas:header -->
                <div class="flex items-center justify-between gap-x-4 sticky top-0 bg-background p-4 z-10">
                    <a href="{{route('home')}}" class="inline-flex items-center gap-2 text-primary">
                        <x-frontend::logo/>
                        <span class="flex flex-col items-start">
                                <span class="font-semibold text-sm text-muted">آکــــادمـــی</span>
                                  <x-frontend::name-web-mobile/>
                            </span>
                    </a>

                    <!-- offcanvas:close-button -->
                    <button x-on:click="offcanvasOpen = false"
                            class="text-foreground focus:outline-none hover:text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button><!-- end offcanvas:close-button -->
                </div><!-- end offcanvas header -->

                <!-- offcanvas:content -->
                <div class="space-y-5 p-4">
                    <label class="relative w-full flex items-center justify-between cursor-pointer">
                        <span class="font-bold text-sm text-foreground">تم تاریک</span>
                        <input type="checkbox" class="sr-only peer" id="dark-mode-checkbox"/>
                        <div
                            class="w-11 h-5 relative bg-background border-2 border-border peer-focus:outline-none rounded-full peer peer-checked:after:left-[26px] peer-checked:after:bg-background after:content-[''] after:absolute after:left-0.5 after:top-0.5 after:bg-border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-primary peer-checked:border-primary">
                        </div>
                    </label>
                    <div class="h-px bg-border"></div>


                </div><!-- end offcanvas:content -->
            </div><!-- end offcanvas:box -->

            <!-- offcanvas:overlay -->
            <div class="fixed inset-0 h-screen bg-secondary/80 cursor-pointer transition-all duration-1000 z-40"
                 x-bind:class="offcanvasOpen ? 'opacity-100 visible' : 'opacity-0 invisible'"
                 x-on:click="offcanvasOpen = false">
            </div><!-- end offcanvas:overlay -->
        </div><!-- end offcanvas -->
    </header>

    <div class="w-full max-w-2xl bg-white shadow-xl rounded-2xl p-6 space-y-6">

        <!-- تایمر -->
        <div class="block justify-between items-center" wire:poll.1s>
            <h2 class="font-bold text-3xl" style="margin-bottom: 10px">{{ $exam['title'] }}</h2>
            @if($remainingSeconds > 0)

                <!-- تایمر -->
                @if(!$examFinished && $remainingSeconds > 0)
                    <div class="text-red-500 font-bold text-xl">
                        <p class="text-2xl">مدت زمان شما:</p>
                        ⏳ {{ gmdate('i:s', $remainingSeconds) }}
                    </div>
                @endif






                <div class="max-w-2xl mx-auto p-6">
                    @if(session()->has('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded-xl shadow mb-6 text-center text-foreground">
                            {{ session('success') }}
                        </div>

                        <div class="bg-white p-6 rounded-xl shadow text-center">
                            <p class="text-xl font-bold text-foreground mb-2">✅ آزمون شما به پایان رسید</p>
                            <p class="text-foreground mb-4">این کد پیگیری آزمون شماست. لطفاً آن را ذخیره کنید:</p>

                            <input
                                type="text"
                                readonly
                                value="{{ $testCheckCode }}"
                                id="trackingCode"
                                onclick="
                                navigator.clipboard.writeText(this.value);
                                alert('کد کپی شد ✅');
                                 window.location.href='{{ route('auth') }}?tracking_code={{ $testCheckCode }}';
                                 "
                                class="w-full max-w-md mx-auto text-center font-bold text-lg border-2 border-green-500 rounded-xl px-4 py-3 cursor-pointer text-foreground"
                            />
                            <p class="mt-3 text-sm text-gray-500">روی کادر کلیک کنید تا کپی شود</p>
                        </div>
                    @elseif(count($answers) == $exam->questions->count())
                        <div class="bg-blue-100 text-blue-800 p-4 rounded-xl shadow mb-6 text-center text-foreground w-full">
                            آزمون شما به پایان رسید ✅
                        </div>

                        <div class=" p-6 rounded-xl shadow text-center">
                            <p class="text-xl font-bold text-foreground mb-2">این کد پیگیری آزمون شماست. لطفاً آن را
                                ذخیره کنید:</p>

                            <input
                                type="text"
                                readonly
                                value="{{ $testCheckCode }}"
                                id="trackingCode"
                                onclick="
        navigator.clipboard.writeText(this.value);
        alert('کد کپی شد ✅');
        window.location.href='{{ route('auth') }}?tracking_code={{ $testCheckCode }}';
    "
                                class="w-full max-w-md mx-auto text-center font-bold text-lg border-2 border-green-500 rounded-xl px-4 py-3 cursor-pointer text-foreground bg-secondary"
                            />
                            <p class="mt-3 text-sm text-yellow-500">روی کادر کلیک کنید تا کپی شود</p>
                        </div>
                    @else
                        @php
                            $q = $exam->questions[$currentIndex];
                        @endphp

                        <div class="bg-white rounded-xl shadow">
                            <h2 class="text-xl font-bold text-foreground">
                                سوال {{ $currentIndex + 1 }} از {{ $exam->questions->count() }}
                            </h2>
                            <p class="text-foreground text-2xl sm:text-2xl text-lg"
                               style="margin-bottom: 20px; margin-top: 10px">{{ $q->question }}</p>

                            <div class="space-y-3">
                                @foreach($q->options as $option)
                                    @php
                                        $isSelected = isset($answers[$q->id]) && $answers[$q->id] == $option->id;
                                    @endphp

                                    <button
                                        wire:click="saveAnswer({{ $option->id }})"
                                        class="flex items-center justify-between w-full text-right rounded-xl px-4 py-3 transition relative bg-secondary"
                                        style="border:2px solid {{ $isSelected ? 'green' : '#444444' }}; cursor:pointer;"
                                    >
                                        <div class="flex items-center gap-3">
                                            {{-- دایره سلکتور سمت چپ --}}
                                            <span
                                                class="inline-block relative"
                                                style="
                                                    width: 20px;
                                                    height: 20px;
                                                    min-width: 20px;
                                                    min-height: 20px;
                                                    max-width: 20px;
                                                    max-height: 20px;
                                                    border:2px solid {{ $isSelected ? 'green' : '#505050' }};
                                                    border-radius:50%;
                                                    background:{{ $isSelected ? 'green' : 'bg-background' }};
                                                    vertical-align:middle;
                                                "
                                            >
                                                <svg
                                                    viewBox="0 0 20 20"
                                                    fill="none"
                                                    width="14"
                                                    height="14"
                                                    style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); display: {{ $isSelected ? 'block' : 'none' }};"
                                                >
                                                    <path d="M5 10.5L9 14L15 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span>

                                            <span class="text-foreground text-xs">{{ $option->option }}</span>
                                        </div>


                                        <x-filament::loading-indicator class="h-5 w-5 text-success" wire:loading="saveAnswer({{ $option->id }})" wire:target="saveAnswer({{ $option->id }})"/>

                                    </button>
                                @endforeach
                            </div>

                        </div>

                        <div class="flex justify-between mt-6">
                            @if($currentIndex > 0)
                                <button
                                    wire:click="$set('currentIndex', {{ $currentIndex - 1 }})"
                                    class="px-5 py-2 rounded-lg border shadow-sm bg-gray-50 hover:bg-gray-100 transition text-foreground"
                                >

                                    ← بازگشت
                                </button>
                            @endif

                            @if($currentIndex < $exam->questions->count() - 1)
                                    <button
                                        wire:click="$set('currentIndex', {{ $currentIndex + 1 }})"
                                        class="px-5 py-2 rounded-lg border shadow-sm bg-gray-50 hover:bg-gray-100 transition text-foreground"
                                    >


                                        بعدی →
                                    </button>
                            @endif
                        </div>
                    @endif
                </div>

            @else
                <div class="bg-blue-100 text-blue-800 p-4 rounded-xl shadow mb-6 text-center text-foreground">
                    آزمون شما به پایان رسید ✅
                </div>

                <div class="bg-secondary p-6 rounded-xl shadow text-center">
                    <p class="text-xl font-bold text-foreground mb-2">این کد پیگیری آزمون شماست. لطفاً آن را
                        ذخیره کنید:</p>

                    <input
                        type="text"
                        readonly
                        value="{{ $testCheckCode }}"
                        id="trackingCode"
                        onclick="
        navigator.clipboard.writeText(this.value);
        alert('کد کپی شد ✅');
        window.location.href='{{ route('auth') }}?tracking_code={{ $testCheckCode }}';
    "
                        class="w-full max-w-md mx-auto text-center font-bold text-lg border-2 border-green-500 rounded-xl px-4 py-3 cursor-pointer text-foreground bg-secondary"
                    />
                    <p class="mt-3 text-sm text-gray-500">روی کادر کلیک کنید تا کپی شود</p>
                </div>
            @endif
        </div>

        <hr class="my-2">


    </div>


</div>

