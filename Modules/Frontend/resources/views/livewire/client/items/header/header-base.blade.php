<header class="relative py-5 z-30" x-data="{ offcanvasOpen: false }">


    {{--header alert inActive your profile--}}
    <livewire:frontend.client.items.alert.alert-in-active-your-profile :$activeUser/>


        @if($alert)
        <!-- notification-item -->
            <livewire:frontend.client.items.alert.change-level-user-alert :$alert/>
        <!-- end notification-item -->
        @endif

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
                                    <x-frontend::nameweb/>
                                </span>
                    </a>
                </div>
                <div class="lg:flex hidden items-center gap-5">
                    <div class="relative group/categories">
                        <a
                           class="inline-flex items-center gap-1 h-10 bg-primary rounded-xl text-primary-foreground transition-colors px-4">
                            <span class="font-semibold text-sm">دسته بندی آمـــوزشها</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                            </svg>
                        </a>
                        <div
                            class="absolute right-0 top-full opacity-0 invisible transition-all group-hover/categories:opacity-100 group-hover/categories:visible pt-5 z-10">



                            <livewire:frontend.client.items.menu.menu-base.menu-items-category />



                        </div>
                    </div>
                    <form action="#" class="flex-grow">
                        <div class="flex items-center relative">
                            <input type="text"
                                   class="form-input !ring-0 !ring-offset-0 h-10 bg-background !border-0 rounded-xl text-foreground"
                                   placeholder="جســـتجو.."/>
                            <span class="absolute left-3 text-muted">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                  d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </span>
                        </div>
                    </form>
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
{{--                    <a href="./cart.html"--}}
{{--                       class="inline-flex items-center justify-center relative w-10 h-10 bg-background rounded-full text-foreground">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
{{--                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                  d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"/>--}}
{{--                        </svg>--}}
{{--                        <span class="absolute -top-1 left-0 flex h-5 w-5">--}}
{{--                                    <span--}}
{{--                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>--}}
{{--                                    <span--}}
{{--                                        class="relative inline-flex items-center justify-center rounded-full h-5 w-5 bg-primary text-primary-foreground font-bold text-xs">2</span>--}}
{{--                                </span>--}}
{{--                    </a>--}}
                    <div class="relative" x-data="{ isOpen: false }">
                        <button class="flex items-center sm:gap-3 gap-1" x-on:click="isOpen = !isOpen">
                                    <span
                                        class="inline-flex items-center justify-center w-9 h-9 bg-background rounded-full text-foreground">
                                        @if($userHasImageProfile)
                                            <img src="{{Storage::url(Auth::user()->userNationalityData->face_image)}}" class="w-full h-full rounded-full " style="{{$activeUser == 1 ? "border: 3px solid green;outline-style: solid;outline-color: #ECFFDC; outline-width: 4px;" : 'border: 3px solid red;outline-style: solid;outline-color: #FFA88B; outline-width: 4px;'}}">
                                        @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="{{$activeUser == 1 ? "border: 3px solid green;outline-style: solid;outline-color: #ECFFDC; outline-width: 4px;" : 'border: 3px solid red;outline-style: solid;outline-color: #FFA88B; outline-width: 4px;'}}"
                                             stroke-width="1.5" stroke="currentColor" class="w-full h-full rounded-full">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                        </svg>
                                        @endif
                                    </span>
                            <span class="xs:flex flex-col items-start hidden text-xs space-y-1">
                                        <span class="font-semibold text-foreground">{{Auth::user()->userInformation->first_name .' '. Auth::user()->userInformation->last_name .' '. 'کاربرعزیز' ?? 'کاربرعزیز'}}</span>
                                        <span class="font-semibold text-muted">خوش آمـــدید</span>
                                    </span>
                            <span class="text-foreground transition-transform"
                                  x-bind:class="isOpen ? 'rotate-180' : ''">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
                                        </svg>
                                    </span>
                        </button>
                        <div class="absolute top-full left-0 pt-3" x-show="isOpen"
                             x-on:click.outside="isOpen = false">

                            <livewire:frontend.client.items.menu.menu-base.menu-items-profile-slider />

                        </div>
                    </div>
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


        {{--start Menu component items link--}}
        <livewire:frontend.client.items.menu.menu-base/>
        {{--end Menu component items link--}}


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
                                  <x-frontend::namewebmobile/>
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
                <form action="#">
                    <div class="flex items-center relative">
                        <input type="text"
                               class="form-input w-full h-10 !ring-0 !ring-offset-0 bg-secondary border border-border focus:border-border rounded-xl text-sm text-foreground pr-10"
                               placeholder="دنبال چی میگردی؟"/>
                        <span class="absolute right-3 text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                         class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                              d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                    </div>
                </form>
                <div class="h-px bg-border"></div>
                <label class="relative w-full flex items-center justify-between cursor-pointer">
                    <span class="font-bold text-sm text-foreground">تم تاریک</span>
                    <input type="checkbox" class="sr-only peer" id="dark-mode-checkbox"/>
                    <div
                        class="w-11 h-5 relative bg-background border-2 border-border peer-focus:outline-none rounded-full peer peer-checked:after:left-[26px] peer-checked:after:bg-background after:content-[''] after:absolute after:left-0.5 after:top-0.5 after:bg-border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-primary peer-checked:border-primary">
                    </div>
                </label>
                <div class="h-px bg-border"></div>


                <livewire:frontend.client.items.menu.menu-base.menu-items-mobile/>


            </div><!-- end offcanvas:content -->
        </div><!-- end offcanvas:box -->

        <!-- offcanvas:overlay -->
        <div class="fixed inset-0 h-screen bg-secondary/80 cursor-pointer transition-all duration-1000 z-40"
             x-bind:class="offcanvasOpen ? 'opacity-100 visible' : 'opacity-0 invisible'"
             x-on:click="offcanvasOpen = false">
        </div><!-- end offcanvas:overlay -->
    </div><!-- end offcanvas -->
</header>
