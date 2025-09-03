<div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-5 mb-8">


    <!-- statistics:item -->
    <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3 {{$activeUser == 1 ? 'border border-2' : 'border border-2'}}" style="{{$activeUser == 1 ? 'border-color:green' : 'border-color:red'}}">
                                    <span
                                        class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-cyan-500">
                                        <!-- آیکون پروفایل -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"
                                             class="w-5 h-5 {{$activeUser == 1 ? 'text-success' : 'text-red-500'}}">
                                            <path fill-rule="evenodd"
                                                  d="M10 2a4 4 0 1 1 0 8 4 4 0 0 1 0-8Zm0 10c-3.314 0-6 1.567-6 3.5V18a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-2.5C16 13.567 13.314 12 10 12Z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </span>
        <div class="flex flex-col items-start text-right space-y-1">
            <span class="font-bold text-xs text-muted line-clamp-1">وضعیت پروفایل</span>
            <span
                class="font-bold text-sm {{$activeUser == 1 ? 'text-success' : 'text-red-500'}} line-clamp-1">{{$activeUser == 1 ? 'فعال است' : 'غیرفعال است!'}}</span>
        </div>
    </div>
    <!-- end statistics:item -->


    <!-- statistics:item -->
    <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3">
                                    <span
                                        class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-green-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                             class="w-5 h-5">
                                            <path fill-rule="evenodd"
                                                  d="M9.664 1.319a.75.75 0 0 1 .672 0 41.059 41.059 0 0 1 8.198 5.424.75.75 0 0 1-.254 1.285 31.372 31.372 0 0 0-7.86 3.83.75.75 0 0 1-.84 0 31.508 31.508 0 0 0-2.08-1.287V9.394c0-.244.116-.463.302-.592a35.504 35.504 0 0 1 3.305-2.033.75.75 0 0 0-.714-1.319 37 37 0 0 0-3.446 2.12A2.216 2.216 0 0 0 6 9.393v.38a31.293 31.293 0 0 0-4.28-1.746.75.75 0 0 1-.254-1.285 41.059 41.059 0 0 1 8.198-5.424ZM6 11.459a29.848 29.848 0 0 0-2.455-1.158 41.029 41.029 0 0 0-.39 3.114.75.75 0 0 0 .419.74c.528.256 1.046.53 1.554.82-.21.324-.455.63-.739.914a.75.75 0 1 0 1.06 1.06c.37-.369.69-.77.96-1.193a26.61 26.61 0 0 1 3.095 2.348.75.75 0 0 0 .992 0 26.547 26.547 0 0 1 5.93-3.95.75.75 0 0 0 .42-.739 41.053 41.053 0 0 0-.39-3.114 29.925 29.925 0 0 0-5.199 2.801 2.25 2.25 0 0 1-2.514 0c-.41-.275-.826-.541-1.25-.797a6.985 6.985 0 0 1-1.084 3.45 26.503 26.503 0 0 0-1.281-.78A5.487 5.487 0 0 0 6 12v-.54Z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
        <div class="flex flex-col items-start text-right space-y-1">
            <span class="font-bold text-xs text-muted line-clamp-1">دوره های سطح شما</span>
            <span class="font-bold text-sm text-foreground line-clamp-1">{{$countCoursesUser}} دوره</span>
        </div>
    </div>
    <!-- end statistics:item -->

    <!-- statistics:item -->
    <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3">
                                    <span
                                        class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-yellow-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M12 3c2.755 0 5.51.513 8.265 1.54a1.5 1.5 0 0 1 .985 1.415v6.5c0 5.25-4.5 9.25-9.25 11.25-4.75-2-9.25-6-9.25-11.25v-6.5a1.5 1.5 0 0 1 .985-1.415C6.49 3.513 9.245 3 12 3Z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 12l2 2 4-4"/>
                                    </svg>
                                    </span>
        <div class="flex flex-col items-start text-right space-y-1">
            <span class="font-bold text-xs text-muted line-clamp-1">بیمه نامه ها(فعال)</span>
            <span class="font-bold text-sm text-foreground line-clamp-1">{{$countInsurancePolicy}}</span>
        </div>
    </div>
    <!-- end statistics:item -->




    <!-- statistics:item -->
    <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3">
    <span class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-red-500 border-2 " style="border-color: red">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M6 18L18 6M6 6l12 12" />
    </svg>
</span>

        <div class="flex flex-col items-start text-right space-y-1">
            <span class="font-bold text-xs text-muted line-clamp-1">بیمه نامه های پرداخت نشده</span>
            <span class="font-bold text-sm text-foreground line-clamp-1">{{$countUnPaidInsurancePolicies}}</span>
        </div>
    </div>
    <!-- end statistics:item -->




    <!-- statistics:item -->
    <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3">
                                    <span
                                        class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-violet-500">
                                       @if(!empty($level->icon))
                                           {!! $level->icon !!}
                                       @else
                                           <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                               <path stroke-linecap="round" stroke-linejoin="round"
                                                     d="M12 3c2.755 0 5.51.513 8.265 1.54a1.5 1.5 0 0 1 .985 1.415v6.5c0 5.25-4.5 9.25-9.25 11.25-4.75-2-9.25-6-9.25-11.25v-6.5a1.5 1.5 0 0 1 .985-1.415C6.49 3.513 9.245 3 12 3Z"/>
                                               <path stroke-linecap="round" stroke-linejoin="round"
                                                     d="M9 12l2 2 4-4"/>
                                           </svg>
                                       @endif

                                    </span>
        <div class="flex flex-col items-start text-right space-y-1">
            <span class="font-bold text-xs text-muted line-clamp-1">سطح شما</span>
            <div class="flex items-center gap-1">
                <span class="font-bold text-sm text-foreground">{{$level->name ?? 'تازه وارد'}}</span>
            </div>
        </div>
    </div>
    <!-- end statistics:item -->



    <!-- statistics:item -->
    <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3">
                                    <span
                                        class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M7 7a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM17 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM5 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM2 19v-1a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v1M17 19v-1a3 3 0 0 0-2-2.83M21 19v-1a3 3 0 0 0-2-2.83" />
                                        </svg>
                                    </span>
        <div class="flex flex-col items-start text-right space-y-1">
            <span class="font-bold text-xs text-muted line-clamp-1">افراد زیرمجموعه(مستقیم/غیرمستقیم)</span>
            <div class="flex items-center gap-1">
                <span class="font-bold text-sm text-foreground">{{Auth::user()->allSubordinates()->count()}}</span>
                <span class="text-xs text-muted">نفر</span>
            </div>
        </div>
    </div>
    <!-- end statistics:item -->

    <!-- statistics:item -->
    <div class="flex items-center gap-3 bg-secondary rounded-2xl cursor-default p-3">
                                    <span
                                        class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-violet-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M7 7a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM17 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM5 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM2 19v-1a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v1M17 19v-1a3 3 0 0 0-2-2.83M21 19v-1a3 3 0 0 0-2-2.83" />
                                        </svg>
                                    </span>
        <div class="flex flex-col items-start text-right space-y-1">
            <span class="font-bold text-xs text-muted line-clamp-1">افراد زیرمجموعه(مستقیم)</span>
            <div class="flex items-center gap-1">
                <span class="font-bold text-sm text-foreground">{{Auth::user()->directSubordinates()->count()}}</span>
                <span class="text-xs text-muted">نفر</span>
            </div>
        </div>
    </div>
    <!-- end statistics:item -->
</div>
