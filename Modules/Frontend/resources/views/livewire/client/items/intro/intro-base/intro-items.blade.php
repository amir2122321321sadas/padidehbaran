<div
    class="flex lg:flex-nowrap flex-wrap lg:flex-row flex-col lg:items-center lg:justify-center gap-10 lg:py-16">
    <div class="space-y-10">
        <div class="space-y-5 max-w-sm">
            <div class="flex flex-wrap items-center gap-2">
                                        <span
                                            class="inline-flex items-center gap-1 bg-primary rounded-full font-semibold text-xs text-primary-foreground animate-pulse py-1 px-2">
                                     {!! $banner->advantage_with_icon !!}

                                            <span>{{$banner->head_amazing_text}}</span>
                                        </span>
                <span class="font-semibold text-xs text-primary">{{$banner->left_head_amazing_text}}</span>
            </div>
            <h2 class="font-black sm:text-5xl text-3xl text-foreground">
                {{$banner->title}}
            </h2>
            <p class="sm:text-base text-sm text-muted">
                {{$banner->description}}
            </p>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{$banner->url}}"
                   class="inline-flex items-center justify-center gap-1 h-11 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                    <span class="whitespace-nowrap font-semibold text-sm">{{$banner->right_button_text_with_icon}}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                         fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                              d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                              clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>

    </div>
    <div
        class="flex-shrink-0 flex justify-center relative lg:w-96 w-full lg:order-2 -order-1 after:content-[''] after:absolute after:bottom-0 after:inset-x-0 after:h-7 after:bg-gradient-to-b after:from-transparent after:to-secondary">
        <img src="{{Storage::url($banner->image)}}" class="sm:w-96 max-w-full" alt="{{$banner->title}}" />
    </div>
</div>
