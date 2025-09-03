@section('head-tags')
    <style>
        .bg-primary{
            background-color: {{$course->them_color}} !important;
        }
    </style>
@endsection
<main class="flex-auto py-5">
    <!-- container -->
    <div class="max-w-7xl space-y-14 px-4 mx-auto">
        <div class="flex lg:flex-nowrap flex-wrap items-start gap-5">
            <div class="lg:w-8/12 w-full">
                <!-- section:title -->
                <div class="flex items-center gap-5 mb-5">
                    <!-- back to course -->
                    <a href="{{route('course-detail' , $course->slug)}}"
                       class="flex items-center justify-center w-12 h-12 bg-primary text-primary-foreground rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m15 15 6-6m0 0-6-6m6 6H9a6 6 0 0 0 0 12h3" />
                        </svg>
                    </a>
                    <div class="flex flex-col space-y-2">
                        <!-- episode:title -->
                        <span class="font-black text-2xl text-primary">{{$courseChapterFile->title}}</span>
                        <!-- course:title -->
                        <span class="font-semibold text-xs text-muted">{{$course->title}}</span>
                    </div>
                </div>
                <!-- end section:title -->

                <!-- episode:video:wrapper -->
                <div class="relative max-w-full rounded-3xl overflow-hidden z-10 h-[500px]">
                    <video id="videoPlayer" class="js-player w-full h-full" playsinline controls
                           data-video-id="{{$courseChapterFile->id}}"
                           data-video-src="{{Storage::url($courseChapterFile->video)}}"
                           poster="{{Storage::url($courseChapterFile->cover)}}">
                        <source type="video/mp4" />
                    </video>

                    <div class="mt-3 flex gap-3">
                        <button id="downloadVideo" class="px-4 py-2 bg-green-500 text-white rounded">دانلود برای آفلاین</button>
                        <button id="playOffline" class="px-4 py-2 bg-blue-500 text-white rounded">پخش آفلاین</button>
                    </div>
                </div>

                <!-- end episode:video:wrapper -->
            </div>
            <div class="lg:w-4/12 w-full lg:sticky lg:top-24 space-y-8">
                <div class="bg-background rounded-2xl">
                    <!-- course:sections:wrapper -->
                    <div class="flex flex-col space-y-1">
                        @foreach($chapters as $chapter)
                            <!-- course:section:accordion -->
                            <div class="w-full space-y-1" x-data="{ open: true }">
                                <!-- accordion:button -->
                                <button type="button"
                                        class="w-full h-14 flex items-center justify-between gap-x-2 relative bg-secondary rounded-2xl transition hover:text-foreground px-5"
                                        x-bind:class="open ? 'text-foreground' : 'text-muted'"
                                        x-on:click="open = !open">
                                        <span class="flex items-center gap-3 text-right">
                                            <span class="font-semibold text-xs line-clamp-1">
                                                {{$chapter->name_order}}</span>
                                            <div class="w-1 h-1 bg-muted-foreground rounded-full"></div>
                                            <span class="font-semibold text-xs"> {{$chapter->title}}</span>
                                        </span>
                                    <span class="" x-bind:class="open ? 'rotate-180' : ''">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                                            </svg>
                                        </span>
                                </button>
                                <!-- end accordion:button -->

                                <!-- accordion:content -->
                                <div class="flex flex-col relative" x-show="open">
                                    <!-- course:section:episodes:wrapper -->
                                    <div
                                        class="bg-background border border-border rounded-2xl space-y-1 overflow-hidden">
                                        @php
                                        $chapterFiles = $chapter->files;
                                        @endphp
                                        @foreach($chapterFiles as $file)

                                            @if($file == $courseChapterFile)
                                                <!-- episode -->
                                                <div
                                                    class="flex sm:flex-nowrap flex-wrap items-center gap-3 bg-primary !text-primary-foreground sm:h-12 p-5">
                                                    <span class="text-xs">{{$file->order}}</span>
                                                    <div class="w-1 h-1 bg-muted-foreground rounded-full">{{$file->order_name}}</div>
                                                    <a href="{{ route('course-detail-file', [$course , $file]) }}"
                                                       class="font-semibold text-xs text-primary-foreground line-clamp-1 transition-all hover:underline">
                                                        {{$file->title}}
                                                    </a>
                                                    <div
                                                        class="flex items-center justify-end gap-3 sm:w-auto w-full mr-auto">
                                                    <span class="flex items-center gap-1">
                                                        <span class="text-xs">{{ gmdate('H:i:s', ($file->total_time ?? 0) * 60) }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                             class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                    </div>
                                                </div>
                                                <!-- end episode -->
                                            @else


                                            <!-- episode -->
                                            <div class="flex sm:flex-nowrap flex-wrap items-center gap-3 sm:h-12 p-5">
                                                <span class="text-xs text-muted">{{$file->order}}</span>
                                                <div class="w-1 h-1 bg-muted-foreground rounded-full">{{$file->order_name}}</div>
                                                <a href="{{ route('course-detail-file', [$course , $file]) }}"
                                                   class="font-semibold text-xs text-foreground line-clamp-1 transition-all hover:underline">
                                                    {{$file->title}}
                                                </a>
                                                <div
                                                    class="flex items-center justify-end gap-3 sm:w-auto w-full mr-auto">
                                                    <span class="flex items-center gap-1 text-muted">
                                                        <span class="text-xs"> {{ gmdate('H:i:s', ($file->total_time ?? 0) * 60) }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                             class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z">
                                                            </path>
                                                        </svg>
                                                    </span>
                                                    <a href="{{ route('course-detail-file', [$course , $file]) }}"
                                                       class="flex items-center h-9 gap-1 bg-secondary rounded-full text-muted transition-colors hover:text-primary px-4">
                                                        <span class="text-xs">مشاهده</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                             fill="currentColor" class="w-5 h-5">
                                                            <path fill-rule="evenodd"
                                                                  d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"
                                                                  clip-rule="evenodd"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- end episode -->

                                            @endif
                                        @endforeach

                                    </div>
                                    <!-- end course:section:episodes:wrapper -->
                                </div>
                                <!-- end accordion:content -->
                            </div>
                            <!-- end course:section:accordion -->
                        @endforeach


                    </div>
                    <!-- end course:sections:wrapper -->
                </div>
            </div>
        </div>
        <div class="flex md:flex-nowrap flex-wrap items-start gap-5">
            <div class="md:w-8/12 w-full">
                <div class="relative">
                    <div class="space-y-10">
                        <!-- tabs container -->
                        <div class="space-y-5"
                             x-data="{ activeTab: 'tabOne', scroll: function() { document.getElementById(this.activeTab).scrollIntoView({ behavior: 'smooth' }) } }">
                            <div class="sticky top-24 z-10">
                                <!-- tabs:list-container -->
                                <div class="relative overflow-x-auto">
                                    <!-- tabs:list -->
                                    <ul
                                        class="inline-flex gap-2 bg-secondary border border-border rounded-full p-1">
                                        <!-- tabs:list:item -->
                                        <li>
                                            <button type="button"
                                                    class="flex items-center gap-x-2 relative rounded-full py-2 px-4"
                                                    x-bind:class="activeTab === 'tabOne' ? 'text-foreground bg-background' : 'text-muted'"
                                                    x-on:click="activeTab = 'tabOne'; scroll();">
                                                <!-- active icon -->
                                                <span x-show="activeTab === 'tabOne'">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                 fill="currentColor" class="w-5 h-5">
                                                                <path
                                                                    d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                <!-- end active icon -->

                                                <!-- inactive icon -->
                                                <span x-show="activeTab !== 'tabOne'">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                 viewBox="0 0 24 24" stroke-width="1.5"
                                                                 stroke="currentColor" class="w-5 h-5">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125">
                                                                </path>
                                                            </svg>
                                                        </span>
                                                <!-- end inactive icon -->

                                                <span
                                                    class="font-semibold text-sm whitespace-nowrap">توضیحات</span>
                                            </button>
                                        </li>
                                        <!-- end tabs:list:item -->

{{--                                        <!-- tabs:list:item -->--}}
{{--                                        <li>--}}
{{--                                            <button type="button"--}}
{{--                                                    class="flex items-center gap-x-2 relative rounded-full py-2 px-4"--}}
{{--                                                    x-bind:class="activeTab === 'tabTwo' ? 'text-foreground bg-background' : 'text-muted'"--}}
{{--                                                    x-on:click="activeTab = 'tabTwo'; scroll();">--}}
{{--                                                <!-- active icon -->--}}
{{--                                                <span x-show="activeTab === 'tabTwo'">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"--}}
{{--                                                                 fill="currentColor" class="w-5 h-5">--}}
{{--                                                                <path--}}
{{--                                                                    d="M3.505 2.365A41.369 41.369 0 0 1 9 2c1.863 0 3.697.124 5.495.365 1.247.167 2.18 1.108 2.435 2.268a4.45 4.45 0 0 0-.577-.069 43.141 43.141 0 0 0-4.706 0C9.229 4.696 7.5 6.727 7.5 8.998v2.24c0 1.413.67 2.735 1.76 3.562l-2.98 2.98A.75.75 0 0 1 5 17.25v-3.443c-.501-.048-1-.106-1.495-.172C2.033 13.438 1 12.162 1 10.72V5.28c0-1.441 1.033-2.717 2.505-2.914Z">--}}
{{--                                                                </path>--}}
{{--                                                                <path--}}
{{--                                                                    d="M14 6c-.762 0-1.52.02-2.271.062C10.157 6.148 9 7.472 9 8.998v2.24c0 1.519 1.147 2.839 2.71 2.935.214.013.428.024.642.034.2.009.385.09.518.224l2.35 2.35a.75.75 0 0 0 1.28-.531v-2.07c1.453-.195 2.5-1.463 2.5-2.915V8.998c0-1.526-1.157-2.85-2.729-2.936A41.645 41.645 0 0 0 14 6Z">--}}
{{--                                                                </path>--}}
{{--                                                            </svg>--}}
{{--                                                        </span>--}}
{{--                                                <!-- end active icon -->--}}

{{--                                                <!-- inactive icon -->--}}
{{--                                                <span x-show="activeTab !== 'tabTwo'">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                                                                 viewBox="0 0 24 24" stroke-width="1.5"--}}
{{--                                                                 stroke="currentColor" class="w-5 h-5">--}}
{{--                                                                <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                                      d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155">--}}
{{--                                                                </path>--}}
{{--                                                            </svg>--}}
{{--                                                        </span>--}}
{{--                                                <!-- end inactive icon -->--}}

{{--                                                <span class="font-semibold text-sm whitespace-nowrap">دیدگاه و--}}
{{--                                                            پرسش</span>--}}
{{--                                            </button>--}}
{{--                                        </li>--}}
{{--                                        <!-- end tabs:list:item -->--}}
                                    </ul>
                                    <!-- end tabs:list -->
                                </div>
                                <!-- end tabs:list-container -->
                            </div>

                            <!-- tabs:contents -->
                            <div class="space-y-8">
                                <!-- tabs:contents:tabOne -->
                                <div class="bg-background rounded-3xl p-5" id="tabOne">
                                    <!-- episode:description -->
                                    <div class="description text-foreground">
                                        {!! $courseChapterFile->description !!}
                                    </div>
                                    <!-- end episode:description -->
                                </div>
                                <!-- end tabs:contents:tabOne -->

{{--                                <!-- tabs:contents:tabTwo -->--}}
{{--                                <div class="bg-background rounded-3xl p-5" id="tabTwo">--}}
{{--                                    <!-- section:title -->--}}
{{--                                    <div class="flex items-center gap-3 mb-5">--}}
{{--                                        <div class="flex items-center gap-1">--}}
{{--                                            <div class="w-1 h-1 bg-foreground rounded-full"></div>--}}
{{--                                            <div class="w-2 h-2 bg-foreground rounded-full"></div>--}}
{{--                                        </div>--}}
{{--                                        <div class="font-black text-foreground">دیدگاه و پرسش</div>--}}
{{--                                    </div>--}}
{{--                                    <!-- end section:title -->--}}

{{--                                    <!-- episode:comments:form:wrapper -->--}}
{{--                                    <div class="bg-background border border-border rounded-3xl p-5 mb-5">--}}
{{--                                        <div class="flex items-center gap-3 mb-5">--}}
{{--                                            <div class="flex items-center gap-1">--}}
{{--                                                <div class="w-1 h-1 bg-foreground rounded-full"></div>--}}
{{--                                                <div class="w-2 h-2 bg-foreground rounded-full"></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="font-black text-xs text-foreground">--}}
{{--                                                ارسال دیدگاه یا پرسش--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="flex flex-wrap items-center gap-3 mb-5">--}}
{{--                                            <div class="flex items-center gap-3 sm:w-auto w-full">--}}
{{--                                                <div--}}
{{--                                                    class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">--}}
{{--                                                    <img src="https://i.pravatar.cc/150?img=14"--}}
{{--                                                         class="w-full h-full object-cover" alt="..." />--}}
{{--                                                </div>--}}
{{--                                                <div class="flex flex-col items-start space-y-1">--}}
{{--                                                    <a href="#"--}}
{{--                                                       class="line-clamp-1 font-semibold text-sm text-foreground hover:text-primary">امید--}}
{{--                                                        تاجیک</a>--}}
{{--                                                    <span class="text-xs text-muted">۲ هفته پیش</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <span class="block w-1 h-1 bg-border rounded-full"></span>--}}
{{--                                            <span class="font-semibold text-xs text-muted">در پاسخ به</span>--}}
{{--                                            <span class="block w-1 h-1 bg-border rounded-full"></span>--}}
{{--                                            <a href="#"--}}
{{--                                               class="line-clamp-1 font-semibold text-sm text-foreground hover:text-primary">جلال--}}
{{--                                                بهرامی راد</a>--}}
{{--                                            <button type="button"--}}
{{--                                                    class="line-clamp-1 font-semibold text-sm text-red-500 mr-auto">لغو--}}
{{--                                                پاسخ</button>--}}
{{--                                        </div>--}}

{{--                                        <!-- episode:comments:form -->--}}
{{--                                        <form action="#" class="flex flex-col space-y-5">--}}
{{--                                                    <textarea name="text" id="text" rows="10"--}}
{{--                                                              class="form-textarea w-full !ring-0 !ring-offset-0 bg-secondary border-0 focus:border-border border-border rounded-xl text-sm text-foreground p-5"--}}
{{--                                                              placeholder="متن مورد نظر خود را وارد کنید ..."></textarea>--}}
{{--                                            <button type="submit"--}}
{{--                                                    class="h-10 inline-flex items-center justify-center gap-1 bg-primary rounded-full text-primary-foreground transition-all hover:opacity-80 px-4 mr-auto">--}}
{{--                                                        <span class="font-semibold text-sm">ثبت دیدگاه یا--}}
{{--                                                            پرسش</span>--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"--}}
{{--                                                     fill="currentColor" class="w-5 h-5">--}}
{{--                                                    <path fill-rule="evenodd"--}}
{{--                                                          d="M14.78 14.78a.75.75 0 0 1-1.06 0L6.5 7.56v5.69a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 5.75 5h7.5a.75.75 0 0 1 0 1.5H7.56l7.22 7.22a.75.75 0 0 1 0 1.06Z"--}}
{{--                                                          clip-rule="evenodd"></path>--}}
{{--                                                </svg>--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                        <!-- end episode:comments:form -->--}}
{{--                                    </div>--}}
{{--                                    <!-- end episode:comments:form:wrapper -->--}}

{{--                                    <!-- episode:comments:wrapper -->--}}
{{--                                    <div class="space-y-3">--}}
{{--                                        <!-- episode:comment -->--}}
{{--                                        <div class="space-y-3">--}}
{{--                                            <div--}}
{{--                                                class="bg-background border border-border rounded-3xl space-y-3 p-5">--}}
{{--                                                <div--}}
{{--                                                    class="flex sm:flex-nowrap flex-wrap sm:flex-row flex-col sm:items-center sm:justify-between gap-5 border-b border-border pb-3">--}}
{{--                                                    <div class="flex items-center gap-3">--}}
{{--                                                        <div--}}
{{--                                                            class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">--}}
{{--                                                            <img src="https://i.pravatar.cc/150?img=14"--}}
{{--                                                                 class="w-full h-full object-cover" alt="..." />--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex flex-col items-start space-y-1">--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="line-clamp-1 font-semibold text-sm text-foreground hover:text-primary">امید--}}
{{--                                                                تاجیک</a>--}}
{{--                                                            <span class="text-xs text-muted">۲ هفته--}}
{{--                                                                        پیش</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="flex items-center gap-3 sm:mr-0 mr-auto">--}}
{{--                                                        <a href="#"--}}
{{--                                                           class="flex items-center h-9 gap-1 bg-secondary rounded-full text-muted transition-colors hover:text-primary px-4">--}}
{{--                                                            <span class="text-xs">پاسخ</span>--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                                 viewBox="0 0 20 20" fill="currentColor"--}}
{{--                                                                 class="w-5 h-5">--}}
{{--                                                                <path fill-rule="evenodd"--}}
{{--                                                                      d="M12.207 2.232a.75.75 0 0 0 .025 1.06l4.146 3.958H6.375a5.375 5.375 0 0 0 0 10.75H9.25a.75.75 0 0 0 0-1.5H6.375a3.875 3.875 0 0 1 0-7.75h10.003l-4.146 3.957a.75.75 0 0 0 1.036 1.085l5.5-5.25a.75.75 0 0 0 0-1.085l-5.5-5.25a.75.75 0 0 0-1.06.025Z"--}}
{{--                                                                      clip-rule="evenodd"></path>--}}
{{--                                                            </svg>--}}
{{--                                                        </a>--}}
{{--                                                        <button type="button"--}}
{{--                                                                class="flex items-center justify-center relative w-9 h-9 bg-secondary rounded-full text-muted transition-colors hover:text-red-500">--}}
{{--                                                            <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                                 viewBox="0 0 20 20" fill="currentColor"--}}
{{--                                                                 class="w-5 h-5">--}}
{{--                                                                <path--}}
{{--                                                                    d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z">--}}
{{--                                                                </path>--}}
{{--                                                            </svg>--}}
{{--                                                            <span--}}
{{--                                                                class="absolute -top-1 -right-1 inline-flex bg-red-500 rounded-full text-xs text-white px-1">--}}
{{--                                                                        ۳--}}
{{--                                                                    </span>--}}
{{--                                                        </button>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <p class="text-sm text-muted">--}}
{{--                                                    من این دوره رو خریدم و میخوام نکست هم بعدا یاد بگیرم--}}
{{--                                                    چون نیاز بیشتری دارم به اموزش های این دوره میشه بدون--}}
{{--                                                    اینکه دوره نکست رو ببینم این دوره رو ببینم(بخش6دوره--}}
{{--                                                    بیشتر مد نظرمه)--}}
{{--                                                </p>--}}
{{--                                            </div>--}}

{{--                                            <!-- episode:comment replies -->--}}
{{--                                            <div--}}
{{--                                                class="relative before:content-[''] before:absolute before:-top-3 before:right-8 before:w-px before:h-[calc(100%-24px)] before:bg-border after:content-[''] after:absolute after:bottom-9 after:right-8 after:w-8 after:h-px after:bg-border space-y-3 pr-16">--}}
{{--                                                <!-- episode:comment reply -->--}}
{{--                                                <div--}}
{{--                                                    class="bg-background border border-border rounded-3xl space-y-3 p-5">--}}
{{--                                                    <div--}}
{{--                                                        class="flex sm:flex-nowrap flex-wrap sm:flex-row flex-col sm:items-center sm:justify-between gap-5 border-b border-border pb-3">--}}
{{--                                                        <div class="flex items-center gap-3">--}}
{{--                                                            <div--}}
{{--                                                                class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">--}}
{{--                                                                <img src="./assets/images/avatars/01.jpeg"--}}
{{--                                                                     class="w-full h-full object-cover"--}}
{{--                                                                     alt="..." />--}}
{{--                                                            </div>--}}
{{--                                                            <div class="flex flex-col items-start space-y-1">--}}
{{--                                                                <a href="#"--}}
{{--                                                                   class="line-clamp-1 font-semibold text-sm text-foreground hover:text-primary">جلال--}}
{{--                                                                    بهرامی راد</a>--}}
{{--                                                                <span class="text-xs text-muted">۲ هفته--}}
{{--                                                                            پیش</span>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex items-center gap-3 sm:mr-0 mr-auto">--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="flex items-center h-9 gap-1 bg-secondary rounded-full text-muted transition-colors hover:text-primary px-4">--}}
{{--                                                                <span class="text-xs">پاسخ</span>--}}
{{--                                                                <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                                     viewBox="0 0 20 20" fill="currentColor"--}}
{{--                                                                     class="w-5 h-5">--}}
{{--                                                                    <path fill-rule="evenodd"--}}
{{--                                                                          d="M12.207 2.232a.75.75 0 0 0 .025 1.06l4.146 3.958H6.375a5.375 5.375 0 0 0 0 10.75H9.25a.75.75 0 0 0 0-1.5H6.375a3.875 3.875 0 0 1 0-7.75h10.003l-4.146 3.957a.75.75 0 0 0 1.036 1.085l5.5-5.25a.75.75 0 0 0 0-1.085l-5.5-5.25a.75.75 0 0 0-1.06.025Z"--}}
{{--                                                                          clip-rule="evenodd"></path>--}}
{{--                                                                </svg>--}}
{{--                                                            </a>--}}
{{--                                                            <button type="button"--}}
{{--                                                                    class="flex items-center justify-center relative w-9 h-9 bg-secondary rounded-full text-muted transition-colors hover:text-red-500">--}}
{{--                                                                <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                                     viewBox="0 0 20 20" fill="currentColor"--}}
{{--                                                                     class="w-5 h-5">--}}
{{--                                                                    <path--}}
{{--                                                                        d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z">--}}
{{--                                                                    </path>--}}
{{--                                                                </svg>--}}
{{--                                                                <span--}}
{{--                                                                    class="absolute -top-1 -right-1 inline-flex bg-red-500 rounded-full text-xs text-white px-1">--}}
{{--                                                                            ۲--}}
{{--                                                                        </span>--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <p class="text-sm text-muted">--}}
{{--                                                        درود امید جان باید next رو ببینی بدون اون که متوجه--}}
{{--                                                        داستان نمیشی--}}
{{--                                                    </p>--}}
{{--                                                </div>--}}
{{--                                                <!-- end episode:comment reply -->--}}

{{--                                                <!-- episode:comment reply -->--}}
{{--                                                <div--}}
{{--                                                    class="bg-background border border-border rounded-3xl space-y-3 p-5">--}}
{{--                                                    <div--}}
{{--                                                        class="flex sm:flex-nowrap flex-wrap sm:flex-row flex-col sm:items-center sm:justify-between gap-5 border-b border-border pb-3">--}}
{{--                                                        <div class="flex items-center gap-3">--}}
{{--                                                            <div--}}
{{--                                                                class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">--}}
{{--                                                                <img src="https://i.pravatar.cc/150?img=14"--}}
{{--                                                                     class="w-full h-full object-cover"--}}
{{--                                                                     alt="..." />--}}
{{--                                                            </div>--}}
{{--                                                            <div class="flex flex-col items-start space-y-1">--}}
{{--                                                                <a href="#"--}}
{{--                                                                   class="line-clamp-1 font-semibold text-sm text-foreground hover:text-primary">امید--}}
{{--                                                                    تاجیک</a>--}}
{{--                                                                <span class="text-xs text-muted">۲ هفته--}}
{{--                                                                            پیش</span>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="flex items-center gap-3 sm:mr-0 mr-auto">--}}
{{--                                                            <a href="#"--}}
{{--                                                               class="flex items-center h-9 gap-1 bg-secondary rounded-full text-muted transition-colors hover:text-primary px-4">--}}
{{--                                                                <span class="text-xs">پاسخ</span>--}}
{{--                                                                <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                                     viewBox="0 0 20 20" fill="currentColor"--}}
{{--                                                                     class="w-5 h-5">--}}
{{--                                                                    <path fill-rule="evenodd"--}}
{{--                                                                          d="M12.207 2.232a.75.75 0 0 0 .025 1.06l4.146 3.958H6.375a5.375 5.375 0 0 0 0 10.75H9.25a.75.75 0 0 0 0-1.5H6.375a3.875 3.875 0 0 1 0-7.75h10.003l-4.146 3.957a.75.75 0 0 0 1.036 1.085l5.5-5.25a.75.75 0 0 0 0-1.085l-5.5-5.25a.75.75 0 0 0-1.06.025Z"--}}
{{--                                                                          clip-rule="evenodd"></path>--}}
{{--                                                                </svg>--}}
{{--                                                            </a>--}}
{{--                                                            <button type="button"--}}
{{--                                                                    class="flex items-center justify-center relative w-9 h-9 bg-secondary rounded-full text-muted transition-colors hover:text-red-500">--}}
{{--                                                                <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                                     viewBox="0 0 20 20" fill="currentColor"--}}
{{--                                                                     class="w-5 h-5">--}}
{{--                                                                    <path--}}
{{--                                                                        d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z">--}}
{{--                                                                    </path>--}}
{{--                                                                </svg>--}}
{{--                                                            </button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <p class="text-sm text-muted">--}}
{{--                                                        خیلی ممنون از راهنماییتون.--}}
{{--                                                    </p>--}}
{{--                                                </div>--}}
{{--                                                <!-- end episode:comment reply -->--}}
{{--                                            </div>--}}
{{--                                            <!-- end episode:comment replies -->--}}
{{--                                        </div>--}}
{{--                                        <!-- end episode:comment -->--}}
{{--                                    </div>--}}
{{--                                    <!-- episode:comments:wrapper -->--}}
{{--                                </div>--}}
{{--                                <!-- end tabs:contents:tabTwo -->--}}
                            </div>
                            <!-- end tabs:contents -->
                        </div>
                        <!-- end tabs container -->
                    </div>
                </div>
            </div>
            <div class="md:w-4/12 w-full md:sticky md:top-24 md:order-2 -order-1 space-y-8">
                <div class="grid lg:grid-cols-3 grid-cols-2 gap-5">
                    <div
                        class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                <span
                                    class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                         class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                              d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                        <div class="flex flex-col items-center justify-center text-center space-y-1">
                            <span class="font-bold text-xs text-muted line-clamp-1">مدت دوره</span>
                            <span class="font-bold text-sm text-foreground line-clamp-1">{{ gmdate('H:i:s', ($course->total_time ?? 0) * 60) }}</span>
                        </div>
                    </div>
                    <div
                        class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                <span
                                    class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                         class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                              d="M4.25 2A2.25 2.25 0 0 0 2 4.25v2.5A2.25 2.25 0 0 0 4.25 9h2.5A2.25 2.25 0 0 0 9 6.75v-2.5A2.25 2.25 0 0 0 6.75 2h-2.5Zm0 9A2.25 2.25 0 0 0 2 13.25v2.5A2.25 2.25 0 0 0 4.25 18h2.5A2.25 2.25 0 0 0 9 15.75v-2.5A2.25 2.25 0 0 0 6.75 11h-2.5Zm9-9A2.25 2.25 0 0 0 11 4.25v2.5A2.25 2.25 0 0 0 13.25 9h2.5A2.25 2.25 0 0 0 18 6.75v-2.5A2.25 2.25 0 0 0 15.75 2h-2.5Zm0 9A2.25 2.25 0 0 0 11 13.25v2.5A2.25 2.25 0 0 0 13.25 18h2.5A2.25 2.25 0 0 0 18 15.75v-2.5A2.25 2.25 0 0 0 15.75 11h-2.5Z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                        <div class="flex flex-col items-center justify-center text-center space-y-1">
                            <span class="font-bold text-xs text-muted line-clamp-1">تعداد جلسات</span>
                            <span class="font-bold text-sm text-foreground line-clamp-1">{{$countFilesCourse}}</span>
                        </div>
                    </div>
                    <div
                        class="flex flex-col items-center justify-center gap-3 bg-secondary border border-border rounded-2xl cursor-default p-3">
                                <span
                                    class="flex items-center justify-center w-12 h-12 bg-background rounded-full text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                         class="w-5 h-5">
                                        <path fill-rule="evenodd"
                                              d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                        <div class="flex flex-col items-center justify-center text-center space-y-1">
                            <span class="font-bold text-xs text-muted line-clamp-1">دسته بندی</span>
                            <span class="font-bold text-sm text-foreground line-clamp-1">{{$course->category->name}}</span>
                        </div>
                    </div>

                </div>
                <div class="space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-1">
                            <div class="w-1 h-1 bg-foreground rounded-full"></div>
                            <div class="w-2 h-2 bg-foreground rounded-full"></div>
                        </div>
                        <div class="font-black text-sm text-foreground">مدرس دوره</div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                                @if(!empty($course->teacher->userNationality))
                                    <img src="{{Storage::url($course->teacher->userNationalityData->face_image)}}"
                                         class="w-full h-full object-cover" alt="{{$course->teacher->userInformation->first_name .' '. $course->teacher->userInformation->last_name}}" />
                                @else
                                    <img src="{{asset('assets/images/avatars/01.jpeg')}}" class="w-full h-full object-cover"
                                         alt="{{$course->teacher->userInformation->first_name . ' ' . $course->teacher->userInformation->first_name}}"/>
                                @endif
                            </div>
                            <div class="flex flex-col items-start space-y-1">
                                <a href="./lecturer.html"
                                   class="line-clamp-1 font-bold text-sm text-foreground hover:text-primary">{{$course->teacher->userInformation->first_name . ' ' . $course->teacher->userInformation->last_name}}</a>
{{--                                <a href="#" class="line-clamp-1 font-semibold text-xs text-primary">دیدن--}}
{{--                                    رزومه</a>--}}
                            </div>
                        </div>
{{--                        <div class="bg-secondary rounded-tl-3xl rounded-b-3xl text-sm text-muted p-5">--}}
{{--                            اول داستان، طراح گرافیک بودم و ۲ سالی به عنوان طراح مشغول بودم،--}}
{{--                            بعد به برنامه‌نویسی علاقمند شدم و الان بیشتر از ۱۰ ساله که عاشق--}}
{{--                            کدزنی و چالش‌های پروژه‌های مختلفم. به تدریس علاقه خاصی دارم و دوست--}}
{{--                            دارم دانشی که در این راه بدست آوردم را در اختیار دیگران قرار بدم--}}
{{--                            :)--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end container -->

</main>


@section('scripts')
soft98.ir
    <script>
        // ==== IndexedDB ====
        async function openDatabase() {
            return new Promise((resolve, reject) => {
                const request = indexedDB.open('videoDB', 1);
                request.onupgradeneeded = e => {
                    e.target.result.createObjectStore('videos', { keyPath: 'id' });
                };
                request.onsuccess = e => resolve(e.target.result);
                request.onerror = e => reject(e.target.error);
            });
        }

        async function saveVideo(id, blob) {
            const db = await openDatabase();
            const tx = db.transaction('videos', 'readwrite');
            tx.objectStore('videos').put({ id, blob });
            await tx.complete;
        }

        async function getVideo(id) {
            const db = await openDatabase();
            return new Promise((resolve, reject) => {
                const tx = db.transaction('videos', 'readonly');
                const request = tx.objectStore('videos').get(id);
                request.onsuccess = e => resolve(e.target.result?.blob);
                request.onerror = e => reject(e.target.error);
            });
        }

        // ==== ویدئو آنلاین و پیش‌فرض ====
        const videoEl = document.getElementById('videoPlayer');
        videoEl.src = videoEl.dataset.videoSrc;

        // ==== دانلود برای آفلاین ====
        document.getElementById('downloadVideo').addEventListener('click', async () => {
            const id = videoEl.dataset.videoId;
            const src = videoEl.dataset.videoSrc;
            const response = await fetch(src);
            const blob = await response.blob();
            await saveVideo(id, blob);
            alert('ویدئو برای آفلاین ذخیره شد!');
        });

        // ==== پخش آفلاین (با دکمه) ====
        document.getElementById('playOffline').addEventListener('click', async () => {
            const id = videoEl.dataset.videoId;
            const blob = await getVideo(id);
            if (blob) {
                videoEl.src = URL.createObjectURL(blob);
                videoEl.play();
            } else {
                alert('این ویدئو هنوز برای آفلاین دانلود نشده!');
            }
        });
    </script>

@endsection




