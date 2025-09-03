<ul class="flex items-center justify-center py-2">

    @foreach($menus as $menu)
        @if(empty($menu->menu_id) && (empty($menu->children) || $menu->children->count() == 0))
            <li>
                <a href="{{$menu->url}}"
                   class="inline-flex text-primary-foreground transition-all hover:opacity-80 py-3 px-4">
                    <span class="font-semibold text-sm">{{$menu->name}}</span>
                </a>
            </li>
        @endif
    @endforeach


    @foreach($menus as $menu)
        @if($menu->children && $menu->children->count())
            <li class="relative group/submenu">
                <a href="{{$menu->url ?? '#'}}"
                   class="inline-flex text-primary-foreground transition-all hover:opacity-80 py-3 px-4">
                    <span class="font-semibold text-sm">{{$menu->name}}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor"
                         class="w-5 h-5 transition-transform group-hover/submenu:rotate-180">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </a>
                <ul
                    class="absolute top-full right-0 w-56 bg-background border border-border rounded-xl shadow-2xl shadow-black/5 opacity-0 invisible transition-all group-hover/submenu:opacity-100 group-hover/submenu:visible p-3 mt-2">
                    @foreach($menu->children as $child)
                        <li>
                            <a href="{{$child->url}}"
                               class="flex items-center gap-2 w-full text-foreground transition-colors hover:text-primary px-3 py-2">
                                <span class="font-semibold text-xs">{{$child->name}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endif
    @endforeach
</ul>
