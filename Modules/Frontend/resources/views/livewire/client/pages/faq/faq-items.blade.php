<!-- faq:question -->
<div x-data="{ open: false }">
    <button class="flex items-center justify-between w-full bg-background p-4 mb-2 rounded-lg py-3" x-on:click="open = !open">
                                <span class="font-bold text-sm text-foreground rtl:text-right ltr:text-left">
                                  {{$faq->question}}
                                </span>
        <span class="text-foreground transition-all" x-bind:class="open ? 'rotate-180' : ''">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </span>
    </button>
    <div class="faq-description space-y-2 pb-3" x-cloak x-show="open">
        {!!$faq->answer!!}
    </div>
</div><!-- end faq:question -->
