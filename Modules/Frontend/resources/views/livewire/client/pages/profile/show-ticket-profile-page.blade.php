<div class="lg:col-span-9 md:col-span-8">
    <div class="space-y-10">
        <div class="space-y-5">
            <!-- section:title -->
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1">
                    <div class="w-1 h-1 bg-foreground rounded-full"></div>
                    <div class="w-2 h-2 bg-foreground rounded-full"></div>
                </div>
                <div class="font-black text-foreground">تیکت شماره: {{$ticket->id}}</div>
            </div>
            <!-- end section:title -->

            <!-- section:tickets:wrapper -->
            <div class="space-y-5">
                <div class="border-b pb-5">
                    <div class="flex items-center justify-center gap-x-3 mb-3">
                        <span class="grow inline-block h-px bg-gradient-to-r from-border"></span>
                        <span class="font-semibold text-xs text-muted">{{\Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($ticket->created_at))->format('Y/m/d')}}</span>
                        <span class="grow inline-block h-px bg-gradient-to-l from-border"></span>
                    </div>
                    <div class="inline-flex items-center gap-2 font-bold text-xs mb-5">
                        <span class="text-muted">شماره تیکت:</span>
                        <span class="text-foreground">{{$ticket->id}}</span>
                    </div>
                    <div class="flex flex-wrap items-center mb-3">
                        <div class="inline-flex items-center gap-2 font-bold text-xs">
                            <span class="text-muted">دپارتمان:</span>
                            <span class="text-foreground">{{$category->name}}</span>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center justify-between mb-2">
                        <div class="flex items-center gap-3 font-bold text-xs">
                            <span class="text-muted">وضعیت:</span>
                            @php
                                $statusLabels = [
                                    'open' => 'باز',
                                    'pending' => 'در انتظار پاسخ پشتیبان',
                                    'closed' => 'بسته',
                                    'hasAnswer' => 'پاسخ داده شده',
                                ];

                                $statusColors = [
                                    'open' => 'text-green-500 before:bg-green-500 before:ring-green-200 dark:before:ring-green-700',
                                    'pending' => 'text-yellow-500 before:bg-yellow-500 before:ring-yellow-200 dark:before:ring-yellow-800',
                                    'closed' => 'text-red-500 before:bg-gray-500 before:ring-gray-200 dark:before:ring-gray-700',
                                    'hasAnswer' => 'text-blue-500 before:bg-blue-500 before:ring-blue-200 dark:before:ring-blue-700',
                                ];
                            @endphp

                            <div
                                class="flex items-center gap-2 {{ $statusColors[$ticket->status] ?? 'text-gray-500 before:bg-gray-500 before:ring-gray-200' }} before:content-[''] before:inline-block before:w-1.5 before:h-1.5  before:rounded-full before:ring  ">
                                <span
                                    class="font-semibold text-xs">{{ $statusLabels[$ticket->status] ?? $ticket->status }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-7 mb-5">
                    <div class="flex flex-wrap flex-col items-start">
                        <div class="inline-flex items-start">
                            <div class="flex flex-col items-start relative">
                                <div class="inline-flex items-center">
                                                        <span class="font-bold text-xs text-foreground">{{$ticket->user->userInformation->first_name . ' ' .$ticket->user->userInformation->last_name}}</span>
                                    <span class="block w-1 h-1 bg-border rounded-full mx-2"></span>
                                    <span class="font-bold text-xxs text-muted"></span>
                                </div>
                                <div
                                    class="relative w-full max-w-md bg-secondary rounded-lg font-semibold text-xs leading-6 text-muted px-3 py-1 my-2">
                                    {{$ticket->message}}
                                    <p>فایل های پیوست داده شده:</p>
                                    @foreach($ticket->getMedia('attachments') as $media)
                                        <div class="mt-2">
                                            <a href="{{ $media->getUrl() }}"
                                               target="_blank"
                                               class="text-blue-600 underline">
                                                دانلود {{ $media->file_name }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-7">
                        <div class="flex items-center mt-2">
                            <span class="w-20 h-px bg-border"></span>
                            <button
                                class="inline-flex font-bold text-xs ms-2 cursor-pointer text-foreground">
                                پاسخها <span class="ms-1">({{$answers->count()}})</span>
                            </button>
                        </div>
                        <div class="flex flex-col space-y-5 pr-5">
                            @foreach($ticket->messages->sortBy('created_at') as $message)
                                <div class="flex flex-wrap justify-start {{ $message->user_id === auth()->id() ? 'ms-auto' : '' }}">
                                    <div class="inline-flex items-start">
                                        <div class="flex flex-col items-start relative">
                                            <div class="inline-flex items-center">
                                                <span class="font-bold text-xs text-foreground">{{$message->user->userInformation->first_name . ' ' .$ticket->user->userInformation->last_name}}</span>
                                                <span class="block w-1 h-1 bg-border rounded-full mx-2"></span>
                                                <span class="font-bold text-xxs text-muted">{{ $message->created_at->diffForHumans() }}</span>
                                            </div>
                                            <div class="relative w-full max-w-md rounded-lg font-semibold text-xs leading-6 px-3 py-1 my-2
                    {{ $message->user_id === auth()->id() ? 'bg-secondary text-muted' : 'bg-blue-500 text-white' }}">
                                                {{ $message->message }}
                                                @foreach($message->getMedia('attachments') as $media)
                                                    <div class="mt-2">
                                                        <a href="{{ $media->getUrl() }}"
                                                           target="_blank"
                                                           class="text-blue-600 underline">
                                                            دانلود {{ $media->file_name }}
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        @if($ticket->status !== 'closed')
                        <div class="space-y-3">
                            <div class="space-y-3">
                                <div class="space-y-2">
                                    <label for="newMessage"
                                           class="block font-semibold text-xs text-foreground">پیامت رو
                                        اینجا بنویس:</label>
                                    <textarea type="text" rows="5" name="newMessage" wire:model="newMessage"
                                              class="form-textarea w-full !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground px-5"></textarea>
                                    @error('newMessage')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="space-y-2" x-data="{
                                    files: null,
                                    previewUrl: null,
                                    isImage: false,
                                    loading: false,
                                    handleFileChange(event) {
                                        this.loading = true;
                                        this.files = Object.values(event.target.files);
                                        if (this.files.length > 0) {
                                            const file = this.files[0];
                                            this.isImage = file.type.startsWith('image/');
                                            if (this.isImage) {
                                                const reader = new FileReader();
                                                reader.onload = (e) => {
                                                    this.previewUrl = e.target.result;
                                                    this.loading = false;
                                                };
                                                reader.readAsDataURL(file);
                                            } else {
                                                this.previewUrl = null;
                                                this.loading = false;
                                            }
                                        } else {
                                            this.previewUrl = null;
                                            this.isImage = false;
                                            this.loading = false;
                                        }
                                    }
                                }">
                                    <label for="subject"
                                           class="block font-semibold text-xs text-foreground">فایل
                                        پیوست:</label>
                                    <label
                                        class="inline-flex items-center gap-x-1 border rounded-full text-muted py-2.5 px-5 cursor-pointer hover:text-foreground"
                                        for="customFile">

                                        <input type="file" class="sr-only" id="customFile" wire:model="file"
                                               x-on:change="handleFileChange($event)">
                                        @error('file')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                        @enderror
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                             fill="currentColor" class="size-4">
                                            <path fill-rule="evenodd"
                                                  d="M11.914 4.086a2 2 0 0 0-2.828 0l-5 5a2 2 0 1 0 2.828 2.828l.556-.555a.75.75 0 0 1 1.06 1.06l-.555.556a3.5 3.5 0 0 1-4.95-4.95l5-5a3.5 3.5 0 0 1 4.95 4.95l-1.972 1.972a2.125 2.125 0 0 1-3.006-3.005L9.97 4.97a.75.75 0 1 1 1.06 1.06L9.058 8.003a.625.625 0 0 0 .884.883l1.972-1.972a2 2 0 0 0 0-2.828Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                        <span class="font-semibold text-xs"
                                              x-text="files ? files.map(file => file.name).join(', ') : 'بارگذاری ..'"></span>
                                        <template x-if="loading">
                                            <svg class="animate-spin ml-2 h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                            </svg>
                                        </template>
                                    </label>
                                    <!-- نوار آپلود شده -->
                                    <template x-if="files && files.length > 0 && !loading">
                                        <div class="mt-2 flex items-center gap-x-2 bg-gray-100 border border-gray-200 rounded-lg px-3 py-2">
                                            <template x-if="isImage && previewUrl">
                                                <img :src="previewUrl" alt="پیش‌نمایش تصویر" class="w-10 h-10 object-cover rounded border" />
                                            </template>
                                            <svg x-show="!isImage" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                            <div class="flex-1 min-w-0">
                                                <span class="block text-xs text-foreground font-semibold truncate" x-text="files.map(file => file.name).join(', ')"></span>
                                                <span class="block text-xxs text-muted truncate" x-text="files[0] ? (Math.round(files[0].size/1024) + ' KB') : ''"></span>
                                            </div>
                                            <button type="button" class="ml-2 text-red-500 hover:text-red-700 text-xs" x-on:click="files = null; previewUrl = null; isImage = false;">
                                                حذف
                                            </button>
                                        </div>
                                    </template>
                                </div>
                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <button type="button" wire:click="saveMessage" wire:loading.attr="disabled"
                                            class="inline-flex items-center justify-center gap-x-1.5 h-10 bg-primary rounded-full text-primary-foreground transition-colors hover:bg-foreground hover:text-background px-6 ms-auto">
                                        <span class="font-semibold text-xs">ارسال پیام</span>
                                        <x-filament::loading-indicator class="h-5 w-5 text-primary" wire:loading
                                                                       wire:target="saveMessage"/>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- end section:tickets:wrapper -->
        </div>
    </div>
</div>
