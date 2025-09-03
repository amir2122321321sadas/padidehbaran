<ul class="flex flex-col relative w-56 min-h-[300px] bg-background border border-border shadow-2xl shadow-black/5">
    @foreach($categories as $category)
        @if(empty($category->category_id))
            <li class="group">
                <a href="{{route('course-category' , $category)}}"
                   class="flex items-center relative text-foreground transition-colors hover:text-primary p-3">
                    <span class="font-semibold text-sm">{{ $category->name }}</span>
                    @if($category->children && $category->children->count())
                        <span class="absolute left-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                 class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 19.5 8.25 12l7.5-7.5"/>
                            </svg>
                        </span>
                    @endif
                </a>
                @if($category->children && $category->children->count())
                    <ul
                        class="absolute -top-px -bottom-px right-full flex flex-wrap flex-col w-96 bg-background border border-border shadow-2xl shadow-black/5 space-y-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible px-3 pt-8 pb-3">
                        <li class="absolute top-2">
                            <span class="font-bold text-sm text-muted cursor-default">محبوب ترین موضوعات</span>
                        </li>
                        @foreach($category->children as $child)
                            <li class="w-1/2">
                                <a href="{{route('course-category' , $child)}}"
                                   class="flex items-center gap-2 text-muted before:content-[''] before:inline-block before:w-1 before:h-1 before:bg-border before:rounded-full transition-colors hover:text-primary hover:before:bg-primary">
                                    <span class="font-semibold text-sm">{{ $child->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endif
    @endforeach
</ul>
