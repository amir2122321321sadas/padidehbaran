<div>
{{--      <!-- alert -->
                                                    <div class="flex items-start gap-3 relative bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-5"
                                                        x-show="open" x-data="{ open: true }">
                                                        <!-- alert:icon -->
                                                        <span class="text-blue-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor" class="w-5 h-5">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </span><!-- alert:icon -->

                                                        <!-- alert:content -->
                                                        <div class="flex flex-col items-start">
                                                            <!-- alert:title -->
                                                            <div class="font-bold text-sm text-blue-500 mb-2">
                                                                سفارش تکمیل شد.
                                                            </div><!-- end alert:title -->

                                                            <!-- alert:desc -->
                                                            <div class="font-semibold text-xs text-zinc-400">
                                                                لورم ایپسوم متن ساختگی با تولید سادگی
                                                                نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است
                                                            </div><!-- end alert:desc -->

                                                            <!-- alert:actions -->
                                                            <div class="flex flex-wrap items-center gap-3 mt-5">
                                                                <a href="#"
                                                                    class="flex items-center gap-x-1 text-cyan-500 hover:!text-blue-500 underline-offset-1 hover:underline">
                                                                    <span class="font-bold text-xs">پیگیری سفارش</span>
                                                                </a>
                                                                <span
                                                                    class="block h-3 w-px bg-zinc-200 dark:bg-zinc-800"></span>
                                                                <button type="button"
                                                                    class="flex items-center gap-x-1 text-zinc-400 underline-offset-1 hover:underline"
                                                                    x-on:click="open = false">
                                                                    <span class="font-bold text-xs">فهمیدم</span>
                                                                </button>
                                                            </div><!-- end alert:actions -->
                                                        </div><!-- end alert:content -->
                                                    </div><!-- end alert -->--}}
    <div class="bg-white rounded-2xl shadow p-4">
        <h2 class="text-lg font-semibold mb-4">درآمد ۱۲ ماه گذشته</h2>
        <div id="incomeLineChart"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var options = {
                chart: {
                    type: 'line',
                    height: 350,
                    toolbar: { show: truew }
                },
                series: [{
                    name: 'درآمد',
                    data: @json($monthlyIncome) // [0,0,0,0,0,0,0,343242342,0,0,0,0]
                }],
                xaxis: {
                    categories: [
                        'فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور',
                        'مهر','آبان','آذر','دی','بهمن','اسفند'
                    ]
                },
                stroke: {
                    curve: 'smooth', // خط نرم و زیبا
                    width: 3
                },
                markers: {
                    size: 5,
                    colors: ['#fff'],
                    strokeColors: '#3b82f6',
                    strokeWidth: 2,
                },
                colors: ['#3b82f6'],
                dataLabels: {
                    enabled: true
                },
                yaxis: {
                    labels: {
                        formatter: function (val) {
                            return val.toLocaleString() + " تومان";
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#incomeLineChart"), options);
            chart.render();
        });
    </script>


    <br>
    <br>
    <br>

    <livewire:frontend.client.pages.profile.courses-profile-page/>

    <br>
    <hr>
    <br>
    <livewire:frontend.client.pages.profile.insurance-policies-profile-page/>

    <br>
    <hr>
    <br>


    <livewire:frontend.client.pages.profile.ticket-list-profile-page/>

    <br>
    <hr>
    <br>


    <livewire:frontend.client.pages.profile.notification-profile-page/>



</div>
