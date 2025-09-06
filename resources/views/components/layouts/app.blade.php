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
        <livewire:frontend.client.items.header.header-base />
        <!-- end header -->
        @endauth



        {{ $slot }}

            @auth
        <!-- footer -->
        <livewire:frontend.client.items.footer.footer-base />
        <!-- end footer -->
            @endauth
    </div>


    @include('partials.scripts')
    @yield('scripts')


    @livewireScripts
    </body>
</html>
