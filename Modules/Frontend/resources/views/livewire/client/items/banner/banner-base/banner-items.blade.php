<div class="swiper-slide">
    <a href="{{$mainBanner->url}}" class="block rounded-2xl overflow-hidden">
        <picture>
            <source srcset="{{Storage::url($mainBanner->image)}}" media="(min-width: 768px)">
            <img src="{{Storage::url($mainBanner->image)}}" class="w-full rounded-2xl" loading="lazy"
                 alt="{{$mainBanner->title}}">
        </picture>
    </a>
</div>
