<div class="lg:col-span-9 md:col-span-8">
    <div class="space-y-10">
        <div class="space-y-5">
            <!-- section:title -->
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1">
                    <div class="w-1 h-1 bg-foreground rounded-full"></div>
                    <div class="w-2 h-2 bg-foreground rounded-full"></div>
                </div>
                <div class="font-black text-foreground">ارسال تیکت</div>

                <a href="{{route('ticket-list')}}"
                   class="inline-flex items-center justify-center gap-x-1.5 h-10 bg-background border rounded-full text-muted transition-colors hover:text-foreground px-6 ms-auto">
                    <span class="font-semibold text-xs">بازگشت</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m15 15 6-6m0 0-6-6m6 6H9a6 6 0 0 0 0 12h3" />
                    </svg>
                </a>
            </div>
            <!-- end section:title -->

            <!-- section:tickets:wrapper -->
            <div class="space-y-5">
                <form action="#" class="w-full md:w-full space-y-3">
                    <div class="space-y-1">
                        <label for="subject" class="font-medium text-xs text-muted">موضوع:</label>
                        <input type="text" id="subject" wire:model.change="title" placeholder="عنوان تیکت را وارد نمایید..."
                               class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground px-5" />
                        @error('title')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="space-y-1">
                        <label for="department" class="font-medium text-xs text-muted">انتخاب
                            دپارتمان:</label>
                        <select id="department" wire:model.change="category"
                                class="form-select w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground px-5">
                            <option value="">انتخاب کنید</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="priority" class="font-medium text-xs text-muted">انتخاب
                            اولویت:</label>
                        <select id="priority" wire:model.change="priority"
                                class="form-select w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground px-5">
                            <option value="">انتخاب کنید</option>
                            @foreach($priorities as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('priority')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-1">
                        <label for="message"
                               class="block font-semibold text-xs text-foreground">توضیحات:</label>
                        <textarea type="text" rows="5" name="message" wire:model.change="message" placeholder="توضیحات تیکت را وارد نمایید..."
                                  class="form-textarea w-full !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground px-5"></textarea>
                        @error('message')
                        <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="space-y-1">
                        <label for="subject"
                               class="block font-semibold text-xs text-foreground">فایل
                            پیوست:</label>
                        <label
                            class="inline-flex items-center gap-x-1 border rounded-full text-muted py-2.5 px-5 cursor-pointer hover:text-foreground"
                            for="customFile" x-data="{ files: null }">
                            <input type="file" class="sr-only" id="customFile" wire:model.change="file"
                                   x-on:change="files = Object.values($event.target.files)">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                 fill="currentColor" class="size-4">
                                <path fill-rule="evenodd"
                                      d="M11.914 4.086a2 2 0 0 0-2.828 0l-5 5a2 2 0 1 0 2.828 2.828l.556-.555a.75.75 0 0 1 1.06 1.06l-.555.556a3.5 3.5 0 0 1-4.95-4.95l5-5a3.5 3.5 0 0 1 4.95 4.95l-1.972 1.972a2.125 2.125 0 0 1-3.006-3.005L9.97 4.97a.75.75 0 1 1 1.06 1.06L9.058 8.003a.625.625 0 0 0 .884.883l1.972-1.972a2 2 0 0 0 0-2.828Z"
                                      clip-rule="evenodd" />
                            </svg>
                            <span class="font-semibold text-xs"
                                  x-text="files ? files.map(file => file.name).join(', ') : 'بارگذاری ..'"></span>
                        </label>
                    </div>


{{--                    <div class="space-y-1">--}}
{{--                        <label for="subject"--}}
{{--                               class="block font-semibold text-xs text-foreground">فایل--}}
{{--                            پیوست:</label>--}}
{{--                        <label--}}
{{--                            class="inline-flex items-center gap-x-1 border rounded-full text-muted py-2.5 px-5 cursor-pointer hover:text-foreground"--}}
{{--                            for="customFile" x-data="{ files: null }">--}}
{{--                            <input type="file" class="sr-only" id="customFile"--}}
{{--                                   x-on:change="files = Object.values($event.target.files)">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"--}}
{{--                                 fill="currentColor" class="size-4">--}}
{{--                                <path fill-rule="evenodd"--}}
{{--                                      d="M11.914 4.086a2 2 0 0 0-2.828 0l-5 5a2 2 0 1 0 2.828 2.828l.556-.555a.75.75 0 0 1 1.06 1.06l-.555.556a3.5 3.5 0 0 1-4.95-4.95l5-5a3.5 3.5 0 0 1 4.95 4.95l-1.972 1.972a2.125 2.125 0 0 1-3.006-3.005L9.97 4.97a.75.75 0 1 1 1.06 1.06L9.058 8.003a.625.625 0 0 0 .884.883l1.972-1.972a2 2 0 0 0 0-2.828Z"--}}
{{--                                      clip-rule="evenodd" />--}}
{{--                            </svg>--}}
{{--                            <span class="font-semibold text-xs"--}}
{{--                                  x-text="files ? files.map(file => file.name).join(', ') : 'بارگذاری ..'"></span>--}}
{{--                        </label>--}}
{{--                    </div>--}}

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="button" wire:click="save"
                                class="inline-flex items-center justify-center gap-x-1.5 h-10 bg-primary rounded-full text-primary-foreground transition-colors hover:bg-secondary hover:text-foreground hover:border border-2 px-6 ms-auto">
                            <span class="font-semibold text-xs">ایجاد تیکت</span>
                            <x-filament::loading-indicator class="h-5 w-5 text-white" wire:loading
                                                           wire:target="save"/>
                        </button>
                    </div>
                </form>
            </div>
            <!-- end section:tickets:wrapper -->
        </div>
    </div>
</div>
