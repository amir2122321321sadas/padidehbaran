<main class="flex-auto py-5">
    <div class="space-y-14">
        <!-- container -->
        <div class="max-w-7xl space-y-14 px-4 mx-auto">

            <!-- slider -->
            <livewire:frontend::client.items.banner.banner-base :$mainBanners/>
            <!-- end slider -->


            <!-- features -->
            <livewire:frontend::client.items.feature.feature-base :$changerItems/>
            <!-- end features -->


            <!-- latest-courses -->
            <livewire:frontend::client.items.course.course-base/>
            <!-- end latest-courses -->


            <!-- counseling -->
            <livewire:frontend::client.items.counseling.counseling-base/>
            <!-- end counseling -->

        </div>
        <!-- end container -->


        <!-- intro -->
        <livewire:frontend::client.items.intro.intro-base/>
        <!-- end intro -->

    </div>

</main>

