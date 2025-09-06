<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>

    @include('partials.head-tags')
    @yield('head-tags')
    @livewireStyles
</head>
<body>
<div class="flex flex-col min-h-screen bg-background">

    @auth
        <!-- header -->
        <livewire:client.items.header.header-base />
        <!-- end header -->
    @endauth




        <main class="flex-auto py-5">
            <div class="max-w-7xl space-y-14 px-4 mx-auto">
                <div class="grid md:grid-cols-12 grid-cols-1 items-start gap-5">
                    <div class="lg:col-span-3 md:col-span-4 md:sticky md:top-24">
                        <!-- user:info -->
                        <div class="flex items-center gap-5 mb-5">
                            <div class="flex items-center gap-3">
                                <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden">
                                    <x-frontend::userinformation.avatar-profile-user-link/>
                                </div>
                                <div class="flex flex-col items-start space-y-1">
                                    <span class="text-xs text-muted">خوش آمدید</span>
                                    <span class="line-clamp-1 font-semibold text-sm text-foreground cursor-default"> <x-frontend::userinformation.fullnameusertext/></span>
                                </div>
                            </div>
                        </div>
                        <!-- end user:info -->

                        <!-- user:menus -->
                        <livewire:client.items.menu-profile.menu-profile-base />
                        <!-- end user:menus -->


                    </div>

                    <div class="lg:col-span-9 md:col-span-8">
                        <div class="space-y-10">



                            <!-- statistics:items:wrapper -->
                            <livewire:client.items.statistic.statistics-base />
                            <!-- end statistics:wrapper -->


                            @yield('content')


                        </div>
                    </div>
                </div>
            </div>
        </main>


    @auth
        <!-- footer -->
        <livewire:client.items.footer.footer-base />
        <!-- end footer -->
    @endauth
</div>

@include('partials.scripts')
@yield('scripts')

@livewireScripts
</body>
</html>
