@php use Morilog\Jalali\Jalalian; @endphp
<div class="space-y-5">
    <!-- table container -->
    <div class="overflow-x-auto">
        <!-- table -->
        <table class="min-w-full divide-y">
            <!-- table:thead -->
            <thead>
            <tr>
                <th scope="col"
                    class="px-6 py-3 whitespace-nowrap text-start text-xs font-semibold text-muted">
                    شماره بیمه نامه
                </th>
                <th scope="col"
                    class="px-6 py-3 whitespace-nowrap text-start text-xs font-semibold text-muted">
                    نوع بیمه نامه
                </th>
                <th scope="col"
                    class="px-6 py-3 whitespace-nowrap text-start text-xs font-semibold text-muted">
                    نوع اقساط
                </th>
                <th scope="col"
                    class="px-6 py-3 whitespace-nowrap text-start text-xs font-semibold text-muted">
                    مبلغ هر قسط
                </th>
                <th scope="col"
                    class="px-6 py-3 whitespace-nowrap text-start text-xs font-semibold text-muted">
                    تاریخ صدور
                </th>
                <th scope="col"
                    class="px-6 py-3 whitespace-nowrap text-start text-xs font-semibold text-muted">
                    وضعیت
                </th>
                <th scope="col"
                    class="px-6 py-3 whitespace-nowrap text-start text-xs font-semibold text-muted">
                    وضعیت پرداخت
                </th>
                <th scope="col"
                    class="px-6 py-3 whitespace-nowrap text-start text-xs font-semibold text-muted">
                    عملیات
                </th>
            </tr>
            </thead><!-- end table:thead -->

            <!-- table:tbody -->
            <tbody class="divide-y">
            @forelse($insurancePolicies as $policy)
                @php
                    $date_of_issue = Jalalian::fromCarbon(
                        \Carbon\Carbon::parse($policy->date_of_issue)
                    )->format('Y/m/d');  // یا 'Y-m-d' بسته به سلیقه;
                @endphp
                <tr class="even:bg-secondary/50 odd:bg-background hover:bg-secondary">
                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-xs text-muted">
                        {{ $policy->insurance_policies_number }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-xs text-muted">
                        {{ \App\Models\InsurancePolicy::TYPE_INSURANCE_POLICIES[$policy->type_insurance_policies] ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-xs text-muted">
                        {{ \App\Models\InsurancePolicy::INSTALLMENT_TYPES[$policy->installment_type] ?? '-' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-xs text-muted">
                        {{ number_format($policy->amount_of_each_installment) }} ریال
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-xs text-muted">
                        {{ $date_of_issue }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $status = $policy->status;
                            $statusText = \App\Models\InsurancePolicy::STATUS_OPTIONS[$status] ?? '-';
                            $statusColor = match($status) {
                                0 => 'text-red-500 before:bg-red-500 before:ring-red-500 dark:before:ring-red-800',
                                1 => 'text-green-500 before:bg-green-500 before:ring-green-200 dark:before:ring-green-800',
                                2 => 'text-yellow-500 before:bg-yellow-500 before:ring-yellow-200 dark:before:ring-yellow-800',
                                3 => 'text-red-500 before:bg-red-500 before:ring-red-200 dark:before:ring-red-800',
                                default => 'text-gray-400 before:bg-gray-400 before:ring-gray-200 dark:before:ring-gray-800'
                            };
                        @endphp
                        <div
                            class="flex items-center gap-3 {{ $statusColor }} before:inline-block before:w-1.5 before:h-1.5 before:rounded-full before:ring">
                            <span class="font-semibold text-xs">{{ $statusText }}</span>
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <div
                            class="flex items-center gap-3 {{ $policy->un_paid === 'true' ? 'text-red-500' : 'text-green-500 before:bg-green-500 before:ring-green-200 dark:before:ring-green-800' }}  ">
        <span class="font-semibold text-xs">
            {{ $policy->un_paid === 'true' ? 'پرداخت نشده' : 'پرداخت شده' }}
        </span>
                        </div>
                    </td>


                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <a href="{{route('show-insurance-policy' , $policy->insurance_policies_number)}}"
                               class="inline-flex items-center gap-x-1 text-cyan-400 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                                <span class="whitespace-nowrap font-semibold text-xs">اطلاعات بیشتر</span>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-muted text-xs">
                        هیچ بیمه نامه‌ای ثبت نشده است.
                    </td>
                </tr>
            @endforelse
            </tbody><!-- end table:tbody -->
        </table><!-- end table -->
    </div><!-- end table container -->
</div>
