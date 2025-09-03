<div class="flex md:flex-nowrap flex-wrap items-start gap-10 py-14">
    @foreach($banners as $banner)
        <div class="flex-grow space-y-8">
            <div class="flex flex-col items-start space-y-3">
                                <span class="text-primary">
                                   {!!$banner->advantages_with_icon!!}
                                </span>
                <h2 class="font-black text-3xl text-foreground">
                    <span class="text-primary">{{$banner->title}}</span>
                </h2>
            </div>
            <div class="text-justify space-y-3">
                <p class="font-medium text-muted">
                    {{$banner->description}}
                </p>
            </div>
        </div>
        <div class="flex-shrink-0 flex justify-center md:w-72 w-full">
            <div class="space-y-3">
                <img src="{{Storage::url($banner->image)}}" class="w-72 max-w-full rounded-3xl"
                     alt="{{$banner->title}}" />
                <a href="{{$banner->url}}"
                   class="flex items-center justify-center gap-1 w-full h-11 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4">
                    <span class="font-semibold text-sm">{{$banner->left_button_text_with_icon}}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="w-5 h-5">
                        <path fill-rule="evenodd"
                              d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                              clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
    @endforeach
</div>
