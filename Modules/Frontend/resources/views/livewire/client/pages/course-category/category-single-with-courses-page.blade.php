<main class="flex-auto py-5">
    <div class="max-w-7xl space-y-14 px-4 mx-auto">
        <div class="space-y-8">
            <!-- section:title -->
            <div class="flex items-center gap-5 bg-gradient-to-l from-secondary to-background rounded-2xl p-5">
                        <span
                            class="flex items-center justify-center w-12 h-12 bg-primary text-primary-foreground rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                 class="w-5 h-5">
                                <path fill-rule="evenodd"
                                      d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
                                      clip-rule="evenodd" />
                            </svg>
                        </span>
                <div class="flex flex-col space-y-2">
                    <span class="font-black xs:text-2xl text-lg text-primary">{{$category->name}}</span>
{{--                    <span class="font-semibold text-xs text-muted">دوره ببین، تمرین کن، برنامه نویس شو</span>--}}
                </div>
            </div>
            <!-- end section:title -->

            <div class="grid md:grid-cols-12 grid-cols-1 items-start gap-5">
                <div class="md:block hidden lg:col-span-3 md:col-span-4 md:sticky md:top-24">
                    <div class="w-full flex flex-col space-y-3 mb-3">
                        <span class="font-bold text-sm text-foreground">جستجو دوره</span>
                        <div>
                            <div class="flex items-center relative">
                                <input type="text" wire:model.live="search"
                                       class="form-input w-full !ring-0 !ring-offset-0 h-10 bg-secondary !border-0 rounded-xl text-sm text-foreground"
                                       placeholder="عنوان دوره..">
                                <span class="absolute left-3 text-muted">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                 fill="currentColor" class="w-5 h-5">
                                                <path fill-rule="evenodd"
                                                      d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="lg:col-span-9 md:col-span-8">
                    <!-- sort & filter(offcanvas) -->
                    <div class="flex items-center gap-3 mb-3" x-data="{ offcanvasOpen: false }">
                        <!-- sort -->
                        <div
                            x-data="{ range: function(start, end) { return Array(end - start + 1).fill().map((_, idx) => start + idx) } }">
                            <!-- form:select container -->
                            <div class="flex items-center gap-3">
                                <!-- form:select:label -->
                                <label
                                    class="sm:flex hidden items-center gap-1 font-semibold text-xs text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                         fill="currentColor" class="w-5 h-5">
                                        <path
                                            d="M10 3.75a2 2 0 1 0-4 0 2 2 0 0 0 4 0ZM17.25 4.5a.75.75 0 0 0 0-1.5h-5.5a.75.75 0 0 0 0 1.5h5.5ZM5 3.75a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5a.75.75 0 0 1 .75.75ZM4.25 17a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5h1.5ZM17.25 17a.75.75 0 0 0 0-1.5h-5.5a.75.75 0 0 0 0 1.5h5.5ZM9 10a.75.75 0 0 1-.75.75h-5.5a.75.75 0 0 1 0-1.5h5.5A.75.75 0 0 1 9 10ZM17.25 10.75a.75.75 0 0 0 0-1.5h-1.5a.75.75 0 0 0 0 1.5h1.5ZM14 10a2 2 0 1 0-4 0 2 2 0 0 0 4 0ZM10 16.25a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z" />
                                    </svg>
                                    مرتب سازی:
                                </label><!-- end form:select:label -->

                                <!-- form:select -->
                                <div class="w-52 relative"
                                     x-data="{ open: false, selectedOption: 'انتخاب کنید', selectedValue: '', options: ['جدید‌ترین', 'در حال برگزاری', 'تکمیل ضبط‌', 'دوره‌های خریداری شده', 'در حال مشاهده', 'قدیمی‌ترین'] }">

                                    <!-- The selected value is stored in this input. -->
                                    <input type="hidden" x-model="selectedValue" />

                                    <!-- form:select:button -->
                                    <button x-on:click="open = !open"
                                            class="flex items-center w-full h-11 relative bg-secondary rounded-2xl font-semibold text-xs text-foreground px-4">
                                        <span class="line-clamp-1" x-text="selectedOption"></span>
                                        <span class="absolute left-3 pointer-events-none transition-transform"
                                              x-bind:class="open ? 'rotate-180' : ''">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </span>
                                    </button><!-- end form:select:button -->

                                    <!-- form:select:options container -->
                                    <div class="absolute w-full bg-background rounded-2xl shadow-lg overflow-hidden mt-2 z-30"
                                         x-show="open" x-on:click.away="open = false">
                                        <ul class="max-h-48 overflow-y-auto">
                                            <template x-for="(month, index) in options" :key="index">
                                                <!-- form:select option -->
                                                <li class="font-medium text-xs text-foreground cursor-pointer hover:bg-secondary px-4 py-3"
                                                    x-on:click="selectedOption = month; selectedValue = (index + 1).toString(); open = false"
                                                    x-text="month"></li><!-- end form:select:option -->
                                            </template>
                                        </ul>
                                    </div><!-- end form:select:options container -->
                                </div><!-- end form:select -->
                            </div><!-- end form:select container -->
                        </div>
                        <!-- end sort -->

                        <!-- filter:offcanvas:button -->
                        <button type="button"
                                class="md:hidden flex items-center gap-1 h-11 bg-secondary rounded-2xl text-foreground px-4"
                                x-on:click="offcanvasOpen = true">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                            </svg>
                            <span class="hidden sm:block font-semibold text-xs">فیلتر دوره ها</span>
                        </button>
                        <!-- end filter:offcanvas:button -->

                        <!-- filter:offcanvas -->
                        <div x-cloak>
                            <!-- offcanvas:box -->
                            <div class="fixed inset-y-0 right-0 xs:w-80 w-72 h-full bg-background rounded-l-2xl overflow-y-auto transition-transform z-50"
                                 x-bind:class="offcanvasOpen ? '!translate-x-0' : 'translate-x-full'">

                                <!-- offcanvas:header -->
                                <div
                                    class="flex items-center justify-between gap-x-4 sticky top-0 bg-background p-4 z-10">
                                    <div class="font-bold text-sm text-foreground">فیلتر دوره ها</div>

                                    <!-- offcanvas:close-button -->
                                    <button x-on:click="offcanvasOpen = false"
                                            class="text-black dark:text-white focus:outline-none hover:text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                    <!-- end offcanvas:close-button -->
                                </div>
                                <!-- end offcanvas header -->

                                <!-- offcanvas:content -->
                                <div class="p-4">
                                    <div class="w-full flex flex-col space-y-3 mb-3">
                                        <span class="font-bold text-sm text-foreground">جستجو دوره</span>
                                        <form action="#">
                                            <div class="flex items-center relative">
                                                <input type="text" wire:model.live="search"
                                                       class="form-input w-full !ring-0 !ring-offset-0 h-10 bg-secondary !border-0 rounded-xl text-sm text-foreground"
                                                       placeholder="عنوان دوره..">
                                                <span class="absolute left-3 text-muted">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                 fill="currentColor" class="w-5 h-5">
                                                                <path fill-rule="evenodd"
                                                                      d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
                                                                      clip-rule="evenodd"></path>
                                                            </svg>
                                                        </span>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                                <!-- end offcanvas:content -->
                            </div>
                            <!-- end offcanvas:box -->

                            <!-- offcanvas:overlay -->
                            <div class="fixed inset-0 bg-black/10 dark:bg-white/10 cursor-pointer transition-all duration-1000 z-40"
                                 x-bind:class="offcanvasOpen ? 'opacity-100 visible' : 'opacity-0 invisible'"
                                 x-on:click="offcanvasOpen = false"></div>
                            <!-- end offcanvas:overlay -->
                        </div>
                        <!-- end filter:offcanvas -->
                    </div>
                    <!-- end sort & filter(offcanvas) -->

                    <!-- courses:wrapper -->
                    <div class="grid lg:grid-cols-3 sm:grid-cols-2 gap-x-5 gap-y-10">

                        @forelse($courses as $course)
                            <!-- course:card -->
                            <livewire:client.items.course.courses-category-items :$course/>
                            <!-- end course:card -->
                        @empty
                            <!-- tabs:contents -->
                            <div class="" style="width:50vw">
                                <!-- tabs:contents:tabTwo -->
                                <div >
                                    <div
                                        class="flex flex-col items-center justify-center w-full max-w-md space-y-12 mx-auto">
                                        <img src="{{asset("assets/images/theme/empty.svg")}}"
                                             class="w-full max-w-xs opacity-35" alt="..." />
                                        <div class="text-center space-y-3">
                                            <h2 class="font-bold text-xl text-foreground">
                                                موردی یافت نشد :)
                                            </h2>
                                            <p class="font-semibold text-sm text-muted">
                                                هنوز دوره ای به صورت کامل مشاهده نکرده اید،بعد از اتمام دوره
                                                هایی که در آن شرکت کرده اید می توانید از این بخش برای
                                                گرفتن مدرک اقدام کنید.
                                            </p>
                                        </div>
                                    </div>
                                </div><!-- end tabs:contents:tabTwo -->
                            </div><!-- end tabs:contents -->
                        @endforelse

                    </div>
                    <!-- courses:wrapper -->

                    <div class="flex justify-center mt-8" wire:loading wire:target="search" >
                        <!-- load more:button -->
                        <button type="button"
                                class="h-11 inline-flex items-center justify-center gap-1 bg-secondary rounded-full text-primary px-8">
                            <span class="font-semibold text-sm">در حال بارگذاری</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="w-5 h-5 animate-spin">
                                <path d="M21 12a9 9 0 1 1-6.219-8.56" />
                            </svg>
                        </button>
                        <!-- end load more:button -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
