<div class="space-y-5">
    <div class="space-y-1">
        <label for="fullname" class="font-medium text-xs text-muted">نام
            و
            نام خانوادگی (فارسی)</label>
        <input type="text" id="fullname" wire:model.change="full_name"
               class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground px-5">
        @error('full_name')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="space-y-1">
        <label for="email" class="font-medium text-xs text-muted">ایمیل</label>
        <input type="email" dir="ltr" id="email" wire:model.change="email"
               class="form-input w-full h-11 !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground px-5">
        @error('email')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="space-y-1">
        <label for="text" class="font-medium text-xs text-muted">متن پیــــام</label>
        <textarea rows="5" id="text" wire:model.change="message"
                  class="form-textarea w-full !ring-0 !ring-offset-0 bg-secondary border-border focus:border-border rounded-xl text-sm text-foreground px-5"></textarea>
        @error('message')
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="flex justify-end gap-5">
        <button type="button" wire:click="saveContactUs" wire:target="saveContactUs"  wire:loading.attr="disabled"
                class="h-11 inline-flex items-center justify-center bg-primary rounded-full text-white px-8 mr-auto">
            <span class="font-semibold text-sm">ارسال پیـــام</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5" wire:loading.remove wire:target="saveContactUs">
                <path fill-rule="evenodd"
                      d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                      clip-rule="evenodd"></path>
            </svg>
            <x-filament::loading-indicator class="h-5 w-5 text-white" wire:loading wire:target="saveContactUs"/>
        </button>
    </div>
    @if (session('status'))
        <div class="text-success">
            {{ session('status') }}
        </div>
    @endif
</div>
