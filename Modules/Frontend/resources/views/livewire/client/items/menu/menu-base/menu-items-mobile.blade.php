<ul class="flex flex-col space-y-1">
    @foreach($menus as $menu)
        @if(empty($menu->menu_id) && (empty($menu->children) || $menu->children->count() == 0))
            <li>
                <a href="{{$menu->url}}"
                   class="w-full flex items-center gap-x-2 relative text-muted transition-all hover:text-foreground py-2">
                    <span class="font-semibold text-xs">{{$menu->name}}</span>
                </a>
            </li>
        @endif
    @endforeach

    @foreach($menus as $menu)
        @if($menu->children && $menu->children->count())
            <li x-data="{ open: false }">
                <button type="button"
                        class="w-full flex items-center gap-x-2 relative transition-all hover:text-foreground py-2"
                        x-bind:class="open ? 'text-foreground' : 'text-muted'" x-on:click="open = !open">
                    <span class="font-semibold text-xs">{{$menu->name}}</span>
                    <span class="absolute rtl:left-3 ltr:right-3"
                          x-bind:class="open ? 'rotate-180' : ''">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                        </svg>
                    </span>
                </button>
                <ul class="flex flex-col relative before:content-[''] before:absolute before:inset-y-3 rtl:before:right-3 ltr:before:left-3 before:w-px before:bg-zinc-200 dark:before:bg-zinc-900 py-3 rtl:pr-5 ltr:pl-5"
                    x-show="open">
                    @foreach($menu->children as $child)
                        @if($child->children && $child->children->count())
                            <li x-data="{ openChild: false }">
                                <button type="button"
                                        class="w-full flex items-center gap-x-2 bg-transparent rounded-xl text-zinc-400 transition-all group/nav-item hover:text-black dark:hover:text-white py-2 px-3"
                                        x-on:click="openChild = !openChild">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-4 h-4"
                                         x-bind:class="openChild ? '-rotate-45' : ''">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 19.5 8.25 12l7.5-7.5"></path>
                                    </svg>
                                    <span class="font-medium text-xs">{{$child->name}}</span>
                                </button>
                                <ul class="flex flex-col relative before:content-[''] before:absolute before:inset-y-3 rtl:before:right-3 ltr:before:left-3 before:w-px before:bg-zinc-200 dark:before:bg-zinc-900 py-3 rtl:pr-5 ltr:pl-5"
                                    x-show="openChild">
                                    @foreach($child->children as $subchild)
                                        <li>
                                            <a href="{{$subchild->url}}"
                                               class="w-full flex items-center gap-x-2 bg-transparent rounded-xl text-zinc-400 transition-all group/nav-item hover:text-black dark:hover:text-white py-2 px-3">
                                                <span
                                                    class="inline-flex w-2 h-px bg-zinc-200 dark:bg-zinc-800 transition-all group-hover/nav-item:w-4 group-hover/nav-item:bg-black dark:group-hover/nav-item:bg-white"></span>
                                                <span class="font-medium text-xs">{{$subchild->name}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li>
                                <a href="{{$child->url}}"
                                   class="w-full flex items-center gap-x-2 bg-transparent rounded-xl text-zinc-400 transition-all group/nav-item hover:text-black dark:hover:text-white py-2 px-3">
                                    <span
                                        class="inline-flex w-2 h-px bg-zinc-200 dark:bg-zinc-800 transition-all group-hover/nav-item:w-4 group-hover/nav-item:bg-black dark:group-hover/nav-item:bg-white"></span>
                                    <span class="font-medium text-xs">{{$child->name}}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endif
    @endforeach
</ul>
