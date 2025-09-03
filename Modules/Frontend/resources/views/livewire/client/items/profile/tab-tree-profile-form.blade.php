<div class="space-y-5" x-show="activeTab === 'tabThree'">
    <div class="flex items-center gap-3">
        <div class="flex items-center gap-1">
            <div class="w-1 h-1 bg-foreground rounded-full"></div>
            <div class="w-2 h-2 bg-foreground rounded-full"></div>
        </div>
        <div class="font-black text-foreground">تغییر رمز عبور</div>
    </div>
    <!-- alert -->
    {{--    <div--}}
    {{--        class="flex items-start gap-3 relative bg-zinc-50 dark:bg-zinc-900 border border-border rounded-xl p-5"--}}
    {{--        x-show="open" x-data="{ open: true }">--}}
    <!-- alert:icon -->
    {{--        <span class="text-yellow-500">--}}
    {{--                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"--}}
    {{--                                                         fill="currentColor" class="w-5 h-5">--}}
    {{--                                                        <path fill-rule="evenodd"--}}
    {{--                                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"--}}
    {{--                                                              clip-rule="evenodd"></path>--}}
    {{--                                                    </svg>--}}
    {{--                                                </span><!-- alert:icon -->--}}

    <!-- alert:content -->
    {{--        <div class="flex flex-col items-start">--}}
    {{--            <!-- alert:title -->--}}
    {{--            <div class="font-bold text-sm text-yellow-500 mb-2">--}}
    {{--                توجه :‌--}}
    {{--            </div><!-- end alert:title -->--}}

    {{--            <!-- alert:desc -->--}}
    {{--            <div class="font-semibold text-xs text-zinc-400">--}}
    {{--                <ul>--}}
    {{--                    <li>حداقل یک حرف کوچک استفاده کنید</li>--}}
    {{--                    <li>حداقل یک حرف بزرگ استفاده کنید</li>--}}
    {{--                    <li>پسورد حداقل باید ۸ کاراکتر باشد</li>--}}
    {{--                    <li>حداقل از یک عدد استفاده کنید</li>--}}
    {{--                </ul>--}}
    {{--            </div><!-- end alert:desc -->--}}

    {{--            <!-- alert:actions -->--}}
    {{--            <div class="flex flex-wrap items-center gap-3 mt-5">--}}
    {{--                <button type="button"--}}
    {{--                        class="flex items-center gap-x-1 text-zinc-400 underline-offset-1 hover:underline"--}}
    {{--                        x-on:click="open = false">--}}
    {{--                    <span class="font-bold text-xs">فهمیدم</span>--}}
    {{--                </button>--}}
    {{--            </div><!-- end alert:actions -->--}}
    {{--        </div><!-- end alert:content -->--}}
    {{--    </div><!-- end alert -->--}}

    <div class="space-y-5">
        <div class="flex flex-col gap-5">
            <div class="space-y-1 sm:w-2">
                <label for="current_password"
                       class="block font-medium text-xs text-muted">پسورد
                    فعلی<span
                        class="text-red-500">*</span></label>
                <input type="text" dir="ltr" id="current_password" wire:model.change="current_password"
                       class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                @error('current_password')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>


        </div>

        <div class="grid sm:grid-cols-2 gap-5">
            <div class="space-y-1">
                <label for="new_password"
                       class="block font-medium text-xs text-muted">پسورد
                    جدید<span
                        class="text-red-500">*</span></label>
                <input type="text" dir="ltr" id="new_password" wire:model.change="new_password"
                       class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                @error('new_password')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="space-y-1">
                <label for="confirm_password"
                       class="block font-medium text-xs text-muted">تکرار پسورد
                    جدید<span
                        class="text-red-500">*</span></label>
                <input type="text" dir="ltr" id="confirm_password" wire:model.change="confirm_password"
                       class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-background border-border focus:border-border rounded-xl text-sm text-foreground px-5"/>
                @error('confirm_password')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="flex justify-end gap-5">
            <button type="button" wire:click="changePassword" wire:target="changePassword" wire:loading.attr="disabled"
                    class="h-11 inline-flex items-center justify-center gap-3 bg-primary rounded-full text-white px-4 mr-auto">
                <span class="font-semibold text-sm">بروزرسانی</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" wire:loading.remove
                     wire:target="changePassword"
                     fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd"
                          d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z"
                          clip-rule="evenodd"></path>
                </svg>

                <x-filament::loading-indicator class="h-5 w-5 text-white" wire:loading wire:target="changePassword"/>

            </button>
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
</div>
