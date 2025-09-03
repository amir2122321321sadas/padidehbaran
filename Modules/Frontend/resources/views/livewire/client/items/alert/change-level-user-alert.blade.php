<div>
    @if($show)
    <div
        class="flex md:items-center items-start gap-5 bg-background border rounded-xl p-5 rgb-border-animated mx-auto mb-3 max-w-7xl" >
        <style>
            .rgb-border-animated {
                position: relative;
                z-index: 0;
            }
            .rgb-border-animated::before {
                content: "";
                position: absolute;
                inset: 0;
                z-index: -1;
                border-radius: 0.75rem; /* rounded-xl */
                padding: 2px;
                background: linear-gradient(
                    270deg,
                    #ff005a,
                    #00ffd0,
                    #00aaff,
                    #ff00ea,
                    #ff005a
                );
                background-size: 600% 600%;
                animation: rgb-border-move 16s ease-in-out infinite;
                -webkit-mask:
                    linear-gradient(#fff 0 0) content-box,
                    linear-gradient(#fff 0 0);
                -webkit-mask-composite: xor;
                mask-composite: exclude;
            }
            @keyframes rgb-border-move {
                0% {
                    background-position: 0% 50%;
                }
                20% {
                    background-position: 20% 60%;
                }
                40% {
                    background-position: 40% 40%;
                }
                60% {
                    background-position: 60% 60%;
                }
                80% {
                    background-position: 80% 40%;
                }
                100% {
                    background-position: 0% 50%;
                }
            }
        </style>
        <div class="flex items-center gap-5">
            🎉
            <div class="w-px h-4 bg-border"></div>
        </div>
        <div class="flex flex-col items-start space-y-1">
            <div class="font-bold text-xs text-foreground">
                {{$alert->title}}
            </div>
            <div class="font-medium text-xs text-muted">
                {{$alert->content}}
            </div>
            <button type="button" wire:click="statusAlert"
                    class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold rounded-full transition-colors duration-200 shadow-sm ">
                ممنونم
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"  wire:loading.remove wire:target="statusAlert">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>

                <x-filament::loading-indicator class="h-3 w-3 text-white" wire:loading
                                               wire:target="statusAlert"/>
            </button>
            <div class="flex flex-col gap-1 font-medium text-xs text-muted">
                <div>
                    زمان: {{ \Morilog\Jalali\Jalalian::fromDateTime($alert->created_at)->format('Y/m/d H:i') }}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
