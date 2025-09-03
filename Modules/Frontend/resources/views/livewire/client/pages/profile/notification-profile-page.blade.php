<div class="lg:col-span-9 md:col-span-8">
    <div class="space-y-10">

        <div class="space-y-5">
            <!-- section:title -->
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1">
                    <div class="w-1 h-1 bg-foreground rounded-full"></div>
                    <div class="w-2 h-2 bg-foreground rounded-full"></div>
                </div>
                <div class="font-black text-foreground">جلسات شما</div>
            </div>
            <!-- end section:title -->

            <!-- section:notifications:wrapper -->
            <div class="space-y-5">
                @forelse($meetings_user as $meet)
                    <!-- notification-item -->
                    <div
                        class="flex md:items-center items-start gap-5 bg-background border border-border rounded-xl p-5">
                        <div class="flex items-center gap-5">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2 7.75A2.75 2.75 0 0 1 4.75 5h2.086a2 2 0 0 0 1.789-1.106l.447-.894A2 2 0 0 1 10.75 2h2.5a2 2 0 0 1 1.728.999l.447.895A2 2 0 0 0 17.164 5h2.086A2.75 2.75 0 0 1 22 7.75v9.5A2.75 2.75 0 0 1 19.25 20H4.75A2.75 2.75 0 0 1 2 17.25v-9.5ZM12 17a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm0-1.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5Z" />
                            </svg>
                            <div class="w-px h-4 bg-border"></div>
                        </div>
                        <div class="flex flex-col items-start space-y-1">
                            <div class="font-bold text-xs text-foreground">
                                {{$meet->title}}
                            </div>
                            <div class="font-medium text-xs text-muted">
                                {{$meet->description}}
                            </div>

                            @if($meet->started_at <= \Carbon\Carbon::now() && $meet->end_at > \Carbon\Carbon::now())
                                <a href="{{ $meet->link }}" target="_blank"
                                   class="inline-flex items-center gap-2 px-4 py-1.5 bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold rounded-full transition-colors duration-200 shadow-sm ">
                                    ورود به جلسه
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            @elseif($meet->end_at < \Carbon\Carbon::now())
                                <span class="text-muted text-success m-3">
                                    جلسه به اتمام رسیده است
                                </span>
                            @elseif($meet->expired_at < \Carbon\Carbon::now())
                                <span class="text-muted text-red-500 m-3">
                                    جلسه منقضی شده است!
                                </span>
                            @else
                                <span class="text-muted text-yellow-500 m-3">
                                    جلسه هنوز شروع نشده است
                                </span>
                            @endif

                            <div class="flex flex-col gap-1 font-medium text-xs text-muted">
                                <div>
                                    زمان شروع: {{ \Morilog\Jalali\Jalalian::fromDateTime($meet->start_at)->format('Y/m/d H:i') }}
                                </div>
                                <div>
                                    زمان پایان: {{ \Morilog\Jalali\Jalalian::fromDateTime($meet->end_at)->format('Y/m/d H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <span>
                        <p colspan="7" class="text-center py-6 text-muted text-xs">
                            هیچ جلسه ای ندارید.
                        </p>
                    </span>
                @endforelse
            </div>
            <!-- end section:notifications:wrapper -->
        </div>



                <div class="space-y-5">
                    <!-- section:title -->
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1">
                            <div class="w-1 h-1 bg-foreground rounded-full"></div>
                            <div class="w-2 h-2 bg-foreground rounded-full"></div>
                        </div>
                        <div class="font-black text-foreground">تغییر سطح شما</div>
                    </div>
                    <!-- end section:title -->

                    <!-- section:notifications:wrapper -->
                    <div class="space-y-5">
                        @forelse($alertsChangeLevel as $alert)
                            <!-- notification-item -->
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
                            <div
                                class="flex md:items-center items-start gap-5 bg-background border rounded-xl p-5 rgb-border-animated">
                                <div class="flex items-center gap-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19V5m0 0l-5 5m5-5l5 5" />
                                    </svg>
                                    <div class="w-px h-4 bg-border"></div>
                                </div>
                                <div class="flex flex-col items-start space-y-1">
                                    <div class="font-bold text-xs text-foreground">
                                        {{$alert->title}}
                                    </div>
                                    <div class="font-medium text-xs text-muted">
                                        {{$alert->content}}
                                    </div>

                                    <div class="flex flex-col gap-1 font-medium text-xs text-muted">
                                        <div>
                                            زمان: {{ \Morilog\Jalali\Jalalian::fromDateTime($alert->created_at)->format('Y/m/d H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end notification-item -->
                            @empty
                                <span>
                        <p colspan="7" class="text-center py-6 text-muted text-xs">
                            هیچ تغییر سطحی ندارید.
                        </p>
                    </span>
                            @endforelse
                    </div>
                    <!-- end section:notifications:wrapper -->
                </div>





    </div>
</div>
