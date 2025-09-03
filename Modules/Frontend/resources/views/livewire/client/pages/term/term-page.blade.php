
<main class="flex-auto py-5">
    <!-- container -->
    <div class="max-w-7xl space-y-14 px-4 mx-auto">
        <div class="max-w-xl space-y-5 mx-auto">
            <div class="flex flex-col items-center justify-center space-y-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                     class="size-10 text-cyan-500">
                    <path
                        d="M10.5 1.875a1.125 1.125 0 0 1 2.25 0v8.219c.517.162 1.02.382 1.5.659V3.375a1.125 1.125 0 0 1 2.25 0v10.937a4.505 4.505 0 0 0-3.25 2.373 8.963 8.963 0 0 1 4-.935A.75.75 0 0 0 18 15v-2.266a3.368 3.368 0 0 1 .988-2.37 1.125 1.125 0 0 1 1.591 1.59 1.118 1.118 0 0 0-.329.79v3.006h-.005a6 6 0 0 1-1.752 4.007l-1.736 1.736a6 6 0 0 1-4.242 1.757H10.5a7.5 7.5 0 0 1-7.5-7.5V6.375a1.125 1.125 0 0 1 2.25 0v5.519c.46-.452.965-.832 1.5-1.141V3.375a1.125 1.125 0 0 1 2.25 0v6.526c.495-.1.997-.151 1.5-.151V1.875Z" />
                </svg>
                <h2
                    class="font-black text-2xl text-center text-foreground bg-gradient-to-l from-transparent to-cyan-300 dark:to-cyan-800 py-5 px-8">
                    {{$term->title}}</h2>
                <div class="flex items-center gap-3 w-40">
                    <span class="block flex-grow h-px bg-border"></span>
                    <span class="w-2 h-2 bg-border rounded-full"></span>
                    <span class="block flex-grow h-px bg-border"></span>
                </div>
            </div>
            <p class="font-semibold text-sm text-center text-muted">
                {{$term->hint}}
            </p>
        </div>
        <div class="max-w-5xl space-y-10 mx-auto">


                <div class="relative bg-background border rounded-xl space-y-5 p-5" x-data="{ expanded: false }"
                     x-bind:class="expanded ? 'pb-20' : 'h-56 overflow-hidden'">
                    <div class="grid gap-y-1.5">
                        <h2 class="font-black text-base text-foreground">
                            قوانین و مقررات وبسایت
                        </h2>
                        <p class="text-foreground">

                            {{$term->description}}

                        </p>

                    </div>


                    <div
                        class="absolute inset-x-0 bottom-0 flex justify-center h-14 bg-gradient-to-t from-background text-foreground">
                        <button type="button"
                                class="inline-flex items-center gap-x-1 h-10 bg-background border rounded-lg px-6"
                                x-on:click="expanded = !expanded">
                            <span class="font-semibold text-xs" x-show="!expanded">نمایش بیشتر</span>
                            <span class="font-semibold text-xs" x-show="expanded">نمایش کمتر</span>

                            <span class="transition-transform" x-bind:class="{ 'rotate-180': expanded }">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                         class="size-4">
                                        <path fill-rule="evenodd"
                                              d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                              clip-rule="evenodd" />
                                    </svg>
                                </span>
                        </button>
                    </div>
                </div>

{{--            <div class="relative bg-background border rounded-xl space-y-5 p-5">--}}
{{--                <div class="grid gap-y-1.5">--}}
{{--                    <h2 class="font-black text-base text-foreground">--}}
{{--                        حریم شخصی کاربران--}}
{{--                    </h2>--}}
{{--                    <p class="font-semibold text-sm text-muted">--}}
{{--                        امروزه حفظ حریم شخصی برای اکثر افراد جامعه بسیار مهم است، همانطور که این مسئله برای ما--}}
{{--                        مهم است . ما در نابغه سعی داریم با حفظ حریم شخصی شما، حاشیه امنی برای فعالیتتان در نابغه--}}
{{--                        بوجود آوریم.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                <div class="font-semibold text-sm text-muted space-y-3">--}}
{{--                    اطلاعاتی که از شما در روند عضویت یا در بخش روزمه‌سازی دریافت میکنیم نزد نابغه محفوظ مانده و--}}
{{--                    در اختیار شخص حقیقی یا حقوقی ثالث به جز در مواردی که به درخواست قانون و مراجع ذی صلاح الزام--}}
{{--                    آور باشد، قرار نخواهد گرفت.--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="grid">--}}
{{--                <div class="flex flex-col items-center justify-center space-y-3">--}}
{{--                    <h2 class="font-black text-xl text-foreground">موارد تکمیلی دیگر</h2>--}}
{{--                    <div class="flex items-center gap-3 w-40">--}}
{{--                        <span class="block flex-grow h-px bg-border"></span>--}}
{{--                        <span class="w-2 h-2 bg-border rounded-full"></span>--}}
{{--                        <span class="block flex-grow h-px bg-border"></span>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <!-- subjects -->
{{--                <div class="divide-y divide-border">--}}
{{--                    <!-- subject -->--}}
{{--                    <div x-data="{ open: false }">--}}
{{--                        <button class="flex items-center justify-between w-full py-3" x-on:click="open = !open">--}}
{{--                                    <span class="font-bold text-sm text-foreground rtl:text-right ltr:text-left">--}}
{{--                                        اعلام نظر و نقد یا پیشنهاد--}}
{{--                                    </span>--}}
{{--                            <span class="text-foreground transition-all"--}}
{{--                                  x-bind:class="open ? 'rotate-180' : ''">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
{{--                                             stroke-width="1.5" stroke="currentColor" class="size-5">--}}
{{--                                            <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5" />--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                        </button>--}}
{{--                        <div class="faq-description space-y-2 pb-3" x-cloak x-show="open">--}}
{{--                            <h2>--}}
{{--                                در صورت مشاهده هرگونه از موارد زیر در بخش نظرات و همچنین بخش بحث و گفتگوهای که--}}
{{--                                توسط شما ایجاد شده، حذف خواهد گردید و در صورت تکرار حساب کاربری شما بسته خواهد--}}
{{--                                شد:--}}
{{--                            </h2>--}}
{{--                            <ul>--}}
{{--                                <li>نشر محتوای نادرست، گمراه کننده، فریبنده، رکیک و بر خلاف شئونات عرف جامعه--}}
{{--                                </li>--}}
{{--                                <li>هر گونه توهین به اشخاص ثالث و تجاوز به حریم خصوصی آن ها</li>--}}
{{--                                <li>هرگونه محتوا حاوی هرزنامه</li>--}}
{{--                                <li>اطلاعات شخصی یا حساس افراد ثالث</li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div><!-- end subject -->--}}

{{--                    <!-- subject -->--}}
{{--                    <div x-data="{ open: false }">--}}
{{--                        <button class="flex items-center justify-between w-full py-3" x-on:click="open = !open">--}}
{{--                                    <span class="font-bold text-sm text-foreground rtl:text-right ltr:text-left">--}}
{{--                                        نظارت بر محتوا--}}
{{--                                    </span>--}}
{{--                            <span class="text-foreground transition-all"--}}
{{--                                  x-bind:class="open ? 'rotate-180' : ''">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
{{--                                             stroke-width="1.5" stroke="currentColor" class="size-5">--}}
{{--                                            <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5" />--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                        </button>--}}
{{--                        <div class="space-y-3 pb-3" x-cloak x-show="open">--}}
{{--                            <p class="font-semibold text-xs text-muted">--}}
{{--                                نابغه حق دارد به صلاحدیدِ خود نوشته‌هایِ کاربران و تولیدکنندگان محتوا که رویِ--}}
{{--                                سرویس قرار می‌گیرند و از قوانین سایت تبعیت نمی کنند را ویرایش و حذف و یا کلا از--}}
{{--                                انتشارِ آن جلوگیری کند. ما در نابغه سعی داریم محتوای سالم و به دور از هر گونه--}}
{{--                                توهینی داشته باشیم .--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div><!-- end subject -->--}}

{{--                    <!-- subject -->--}}
{{--                    <div x-data="{ open: false }">--}}
{{--                        <button class="flex items-center justify-between w-full py-3" x-on:click="open = !open">--}}
{{--                                    <span class="font-bold text-sm text-foreground rtl:text-right ltr:text-left">--}}
{{--                                        عدم رعایت قوانین--}}
{{--                                    </span>--}}
{{--                            <span class="text-foreground transition-all"--}}
{{--                                  x-bind:class="open ? 'rotate-180' : ''">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
{{--                                             stroke-width="1.5" stroke="currentColor" class="size-5">--}}
{{--                                            <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5" />--}}
{{--                                        </svg>--}}
{{--                                    </span>--}}
{{--                        </button>--}}
{{--                        <div class="space-y-3 pb-3" x-cloak x-show="open">--}}
{{--                            <p class="font-semibold text-xs text-muted">--}}
{{--                                در صورت عدم رعایت قوانین مندرج شده در این صفحه، نابغه این حق را برای خود محفوظ--}}
{{--                                می‌دارد که بلافاصله دسترسی شما به وبسایت را معلق کند یا به طور کلی به پایان--}}
{{--                                برساند و اکانتِ شما (یا بخشی از آن) را مسدود کند.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div><!-- end subject -->--}}
{{--                </div><!-- end subjects -->--}}
{{--            </div>--}}

            @guest
            <a href="{{route('auth')}}"
                    class="inline-flex items-center gap-x-1 h-10 bg-primary text-white border rounded-lg px-6 cursor-pointer"
            >
                <span class="font-semibold text-xs">بازگشت به صفحه ورود</span>

                <span class="transition-transform" x-bind:class="{ 'rotate-180': expanded }">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5" wire:target="changePassword" wire:loading.remove>
                            <path fill-rule="evenodd"
                                  d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                  clip-rule="evenodd"></path>
                        </svg>
                                </span>
            </a>
            @endguest
        </div>
    </div>
    <!-- end container -->
</main>
