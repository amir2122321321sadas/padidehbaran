
<div>
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

    <main class="bg-background" style="flex:1 1 auto; padding-top:40px; padding-bottom:40px; ">

        <div style="max-width:1280px; margin:0 auto; padding-left:16px; padding-right:16px; display:flex; flex-direction:column; gap:32px; z-index:1;">

            <h1  style="font-size:2.25rem; font-weight:800; text-align:center; margin-bottom:24px;color: green">
                تمام آزمون‌ها
            </h1>

            <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap:32px;">
                @foreach($exams as $exam)
                    <div class="bg-secondary" style="position:relative; border-radius:24px; box-shadow:0 10px 25px rgba(0,0,0,0.1); padding:24px; display:flex; flex-direction:column; justify-content:space-between; transition: transform 0.3s ease, box-shadow 0.3s ease;border: 3px solid green" onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 20px 40px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.1)'">



                        <div style="display:flex; flex-direction:column; gap:16px;">
                            <h2 class="text-foreground" style="font-size:1.5rem; font-weight:700;">{{ $exam->title }}</h2>
                            <p class="text-foreground" style="font-size:0.875rem; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                {{ Str::limit($exam->description, 80) }}
                            </p>

                            <p style="font-size:0.875rem; color:#6b7280;">تعداد سوال‌ها: <span style="font-weight:600;">{{ $exam->questions->count() }}</span></p>
                            <p style="font-size:0.875rem; color:#6b7280;">مدت زمان: <span style="font-weight:600;">{{  gmdate('H:i', ($exam->time ?? 0) * 60) }} ساعت</span></p>
                        </div>

                        <div style="margin-top:24px;">
                            <a href="{{ route('exam.start', $exam->slug) }}"
                               style="display:block; text-align:center; background: linear-gradient(to right, #0f5728, #128c3d); color:white; font-weight:700; padding:12px 0; border-radius:16px; box-shadow:0 5px 15px rgba(0,0,0,0.1); text-decoration:none;border-color: none"
                               onmouseover="this.style.boxShadow='0 10px 25px rgba(0,0,0,0.2)'" onmouseout="this.style.boxShadow='0 5px 15px rgba(0,0,0,0.1)'">
                                شروع آزمون
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @guest
                <div style="text-align:center; margin-top:40px;">
                    <a href="{{ route('auth') }}"
                       style="display:inline-flex; align-items:center; gap:8px; height:48px; background: linear-gradient(to right, #0f5728, #13753a); color:white; border-radius:12px; padding:0 24px; font-weight:600; text-decoration:none; box-shadow:0 5px 15px rgba(0,0,0,0.1);"
                       onmouseover="this.style.boxShadow='0 10px 25px rgba(0,0,0,0.2)'" onmouseout="this.style.boxShadow='0 5px 15px rgba(0,0,0,0.1)'">
                        بازگشت به صفحه ورود
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="width:20px;height:20px;">
                            <path fill-rule="evenodd"
                                  d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            @endguest

        </div>
    </main>

</div>
