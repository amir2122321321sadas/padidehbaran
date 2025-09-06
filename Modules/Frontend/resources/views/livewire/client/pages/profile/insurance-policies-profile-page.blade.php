<div class="lg:col-span-9 md:col-span-8">
    <div class="space-y-10">
        <div class="space-y-5">
            <!-- section:title -->
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1">
                    <div class="w-1 h-1 bg-foreground rounded-full"></div>
                    <div class="w-2 h-2 bg-foreground rounded-full"></div>
                </div>
                <div class="font-black text-foreground">بیمه نامه های من</div>

                <a href="{{route('create-insurance-policy')}}"
                   class="inline-flex items-center justify-center gap-x-1.5 h-10 bg-primary rounded-full text-primary-foreground transition-colors hover:bg-foreground hover:text-background px-6 ms-auto">
                    <span class="font-semibold text-xs">ثبت بیمه نامه جدید</span>
                    <!-- آیکون بیمه نامه (سپر محافظ) -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 3c2.755 0 5.51.513 8.265 1.54a1.5 1.5 0 0 1 .985 1.415v6.5c0 5.25-4.5 9.25-9.25 11.25-4.75-2-9.25-6-9.25-11.25v-6.5a1.5 1.5 0 0 1 .985-1.415C6.49 3.513 9.245 3 12 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12l2 2 4-4" />
                    </svg>
                </a>
            </div>
            <!-- end section:title -->

            <!-- section:tickets:wrapper -->
            <livewire:client.items.profile.data.insurance-policies-profile />
            <!-- end section:tickets:wrapper -->
        </div>
    </div>
</div>
