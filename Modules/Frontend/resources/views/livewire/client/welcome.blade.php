<main class="flex-auto py-5">
    <div class="space-y-14">
        <!-- container -->
        <div class="max-w-7xl space-y-14 px-4 mx-auto">

            <!-- slider -->
            <livewire:client.items.banner.banner-base :$mainBanners  wire:key="banner-{{ now() }}"/>
            <!-- end slider -->


            <!-- features -->
            <livewire:client.items.feature.feature-base :$changerItems  wire:key="feature-{{ now() }}"/>
            <!-- end features -->


            <!-- latest-courses -->
            <livewire:client.items.course.course-base/>
            <!-- end latest-courses -->


            <!-- counseling -->
            <livewire:client.items.counseling.counseling-base/>
            <!-- end counseling -->

        </div>
        <!-- end container -->


        <!-- intro -->
        <livewire:client.items.intro.intro-base/>
        <!-- end intro -->

    </div>

</main>

