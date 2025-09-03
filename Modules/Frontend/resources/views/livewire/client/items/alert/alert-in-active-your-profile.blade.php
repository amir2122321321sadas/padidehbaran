@if($activeUser == 0)
    <!-- notification-item -->
    <div style="outline-style: solid;outline-color: #ff004e; outline-width: 4px; outline-offset: 4px;border-color: red; margin-bottom: 20px"
         class="flex md:items-center items-start gap-5 bg-background  border-2  rounded-xl p-5 container mx-auto max-w-7xl">
        <div class="flex items-center gap-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6 " style="color: red">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            <div class="w-px h-4 bg-border"></div>
        </div>
        <div class="flex flex-col items-start space-y-1">
            <div class="font-bold text-xs text-foreground">
                پروفایل شما غیرفعال است!
            </div>
            <div class="font-medium text-xs text-muted">
                {{Auth::user()->userInformation->first_name .' '. Auth::user()->userInformation->last_name}} عزیز پروفایل شما غیرفعال میباشد
                لطفابرای فعال شدن پروفایل خود بیمه نامه ای ثبت کنید
            </div>
            {{--            <div class="flex items-center gap-1 font-medium text-xs text-muted">--}}
            {{--                ۶ روز پیش--}}
            {{--            </div>--}}
        </div>
    </div>
    <!-- end notification-item -->
@elseif($activeUser == 2)

    <!-- notification-item -->
    <div style="outline-style: solid;outline-color: #ff0000; outline-width: 4px; outline-offset: 4px;border-color: #ff004e; margin-bottom: 20px"
         class="flex md:items-center items-start gap-5 bg-background  border-2  rounded-xl p-5 mx-auto max-w-7xl">
        <div class="flex items-center gap-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6 " style="color: red">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            <div class="w-px h-4 bg-border"></div>
        </div>
        <div class="flex flex-col items-start space-y-1">
            <div class="font-bold text-xs text-foreground">
                بیمه نامه پرداخت نشده دارید!
            </div>
            <div class="font-medium text-xs text-muted">
                {{Auth::user()->userInformation->first_name .' '. Auth::user()->userInformation->last_name}} عزیز
                شما بیمه نامه پرداخت نشده دارید ، برای فعال شدن دوباره پروفایلتان ، بیمه نامه های پرداخت نشده را پیگیری نمایید
            </div>
            {{--            <div class="flex items-center gap-1 font-medium text-xs text-muted">--}}
            {{--                ۶ روز پیش--}}
            {{--            </div>--}}
        </div>
    </div>
    <!-- end notification-item -->

@else
    <!-- notification-item -->
    <div></div>
    <!-- end notification-item -->

@endif
