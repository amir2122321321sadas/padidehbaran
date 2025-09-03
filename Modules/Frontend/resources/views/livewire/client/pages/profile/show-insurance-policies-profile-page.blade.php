<div class="lg:col-span-9 md:col-span-8">
    <div class="space-y-10">
        <div class="space-y-5">
            <!-- section:title -->
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1">
                    <div class="w-1 h-1 bg-foreground rounded-full"></div>
                    <div class="w-2 h-2 bg-foreground rounded-full"></div>
                </div>
                <div class="font-black text-foreground">مشاهده بیمه نامه:{{$insurance_policies_number}}</div>
            </div>
            <!-- end section:title -->


            <div class="bg-background rounded-xl border border-border p-8 max-w-3xl mx-auto space-y-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <div>
                        <div class="text-xs text-muted mb-1">شماره بیمه نامه</div>
                        <div class="font-semibold text-foreground">{{ $insurance_policies_number }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-muted mb-1">تاریخ صدور</div>
                        <div class="font-semibold text-foreground">
                            {{ \Morilog\Jalali\Jalalian::fromCarbon(\Carbon\Carbon::parse($date_of_issue))->format('Y/m/d') }}
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-muted mb-1">نوع بیمه نامه</div>
                        <div class="font-semibold text-foreground">
                            {{ \App\Models\InsurancePolicy::TYPE_INSURANCE_POLICIES[$type_insurance_policies] ?? '-' }}
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-muted mb-1">نوع اقساط</div>
                        <div class="font-semibold text-foreground">
                            {{ \App\Models\InsurancePolicy::INSTALLMENT_TYPES[$installment_type] ?? '-' }}
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-muted mb-1">مبلغ هر قسط</div>
                        <div class="font-semibold text-foreground">
                            {{ number_format($amount_of_each_installment) }} ریال
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-muted mb-1">وضعیت</div>
                        <div class="font-semibold text-foreground">
                            <span class="font-semibold text-lg">{{ $status }}</span>
                        </div>
                    </div>
                    <div>
                        <div class="text-xs text-muted mb-1 mt-5">وضعیت پرداخت اقساط</div>
                        <div class="font-semibold text-foreground">
                            <span class="font-semibold text-lg {{ $unPaid === 'true' ? 'text-red-500' : 'text-success' }}">{{ $unPaid === 'true' ? 'اقساط پرداخت نشده دارد' : 'پرداخت شده' }}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="text-xs text-muted mb-2">تصاویر بیمه نامه</div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @php
                            use Illuminate\Support\Facades\Storage;
                            $imagesArray = is_array($images) ? $images : (json_decode($images, true) ?? []);
                        @endphp
                        @forelse($imagesArray as $img)
                            <a href="{{ Storage::url($img) }}" target="_blank" class="block">
                                <img src="{{ Storage::url($img) }}" alt="تصویر بیمه نامه"
                                     class="rounded-xl w-40 h-40 object-cover rounded border border-border shadow-sm hover:scale-105 transition"/>
                            </a>
                        @empty
                            <span class="text-xs text-muted col-span-full">تصویری ثبت نشده است.</span>
                        @endforelse
                    </div>
                </div>
            </div>

            @if($unPaid  === 'true')
                <!-- section:title -->
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-1">
                        <div class="w-1 h-1 bg-foreground rounded-full"></div>
                        <div class="w-2 h-2 bg-foreground rounded-full"></div>
                    </div>
                    <div class="font-black text-foreground">اقساط پرداخت نشده</div>
                </div>
                <!-- end section:title -->
                <table class="min-w-full border border-gray-200">
                    <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="px-4 py-2 border text-foreground">بیمه‌گذار</th>
                        <th class="px-4 py-2 border text-foreground">شماره همراه بیمه‌گذار</th>
                        <th class="px-4 py-2 border text-foreground">بیمه شده</th>
                        <th class="px-4 py-2 border text-foreground">واحد صدور بیمه‌نامه</th>
                        <th class="px-4 py-2 border text-foreground">تاریخ سررسید</th>
                        <th class="px-4 py-2 border text-foreground">مبلغ قسط</th>
                        <th class="px-4 py-2 border text-foreground">مانده قسط</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($checkerExcels as $checker)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 border text-foreground">{{ $checker->policyholder }}</td>
                            <td class="px-4 py-2 border text-foreground" dir="ltr">{{ $checker->policyholder_mobile }}</td>
                            <td class="px-4 py-2 border text-foreground">{{ $checker->insured }}</td>
                            <td class="px-4 py-2 border text-foreground">{{ $checker->issuing_unit }}</td>
                            <td class="px-4 py-2 border text-foreground">{{ $checker->installment_due_date }}</td>
                            <td class="px-4 py-2 border text-foreground">{{ $checker->installment_amount }} ريال</td>
                            <td class="px-4 py-2 border text-foreground">{{ $checker->installment_balance}} ريال</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif


        </div>
    </div>
</div>
