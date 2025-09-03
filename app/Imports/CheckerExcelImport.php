<?php

namespace App\Imports;

use App\Models\CheckerExcel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

class CheckerExcelImport implements ToModel, WithHeadingRow
{
    /** @var array<string,string> */
    private array $keyMap = [];

    public function __construct()
    {
        //حذف تمام دیتا ها و بعد از آن ایمپورت دیتاهای داخل اکسل
//        CheckerExcel::truncate();


        // هدرها رو دقیقا همون‌طور که در اکسل هست نگه می‌داره (فارسی)
        HeadingRowFormatter::default('none');
    }

    /**
     * هر ردیف از اکسل -> یک مدل
     */
    public function model(array $row)
    {
        // در اولین ردیف، مپ کلیدها رو بساز (با نرمال‌سازی)
        if (empty($this->keyMap)) {
            foreach (array_keys($row) as $k) {
                $this->keyMap[$this->norm($k)] = $k;
            }
        }


        return new CheckerExcel([
            'policy_number'                   => $this->v($row, 'شماره بیمه نامه'),
            'policy_type'                     => $this->v($row, 'نوع بیمه نامه'),
            'contract'                        => $this->v($row, 'قرارداد'),
            'policyholder'                    => $this->v($row, 'بیمه گذار'),
            'policyholder_national_id'        => $this->v($row, 'شماره ملی بیمه گذار'),
            'policyholder_mobile'             => $this->v($row, 'تلفن همراه بیمه گذار'),
            'insured'                         => $this->v($row, 'بیمه شده'),
            'currency_unit'                   => $this->v($row, 'واحدپولی'),
            'issue_date'                      => $this->v($row, 'تاریخ صدور بیمه نامه'),
            'start_date'                      => $this->v($row, 'تاریخ شروع'),
            'end_date'                        => $this->v($row, 'تاریخ پایان'),
            'issuing_unit'                    => $this->v($row, 'واحد صدور'),
            'issuing_unit_code'               => $this->v($row, 'کد واحدصدور'),
            'issuing_province'                => $this->v($row, 'استان واحد صدور'),
            'issuing_city'                    => $this->v($row, 'شهر واحد صدور'),
            'issuing_supervisor'              => $this->v($row, 'ناظر واحد صدور'),
            'issuing_supervisor_code'         => $this->v($row, 'کد ناظر واحد صدور'),
            'introducer'                      => $this->v($row, 'معرف'),
            'introducer_code'                 => $this->v($row, 'کد معرف'),
            'sales_org_code'                  => $this->v($row, 'کد سازمان فروش'),
            'sales_org_introducers'           => $this->v($row, 'معرف ها در سازمان فروش'),
            'year_number'                     => $this->v($row, 'شماره سال'),
            'installment_number'              => $this->v($row, 'شماره قسط'),
            'installment_due_date'            => $this->v($row, 'تاریخ سررسید قسط'),
            'installment_amount'              => $this->v($row, 'مبلغ قسط'),
            'installment_balance'             => $this->v($row, 'مانده قسط'),
            'life_insurance_premium'          => $this->v($row, 'حق بیمه عمر'),
            'supplementary_insurance_premium' => $this->v($row, 'حق بیمه تکمیلی'),
            'savings_amount'                  => $this->v($row, 'مبلغ پس انداز'),
            'sales_cost'                      => $this->v($row, 'هزینه فروش'),
            'collection_cost'                 => $this->v($row, 'هزینه وصول'),
            'supplementary_commission'        => $this->v($row, 'کارمزد پوشش تکمیلی'),
            'administrative_cost'             => $this->v($row, 'هزینه اداری'),
            'insurance_cost'                  => $this->v($row, 'هزینه بیمه گری'),
            'deposit_commission'              => $this->v($row, 'کارمزد واریز اندوخته'),
            'deposit_profit'                  => $this->v($row, 'سود سپرده'),
            'identifier_code'                 => $this->v($row, 'کدشناسه'),
            'payment_identifier'              => $this->v($row, 'شناسه پرداخت'),
        ]);
    }

    /**
     * ردیف هدر در اکسل (پیش‌فرض 1 هست؛ همین خوبه)
     */
    public function headingRow(): int
    {
        return 1;
    }

    /**
     * مقداردهی امن با نام ستون فارسی (فارغ از فاصله/نیم‌فاصله و ي/ك عربی)
     */
    private function v(array $row, string $label)
    {
        $norm = $this->norm($label);
        if (isset($this->keyMap[$norm])) {
            $realKey = $this->keyMap[$norm];
            return $row[$realKey] ?? null;
        }
        return null;
    }

    /**
     * نرمال‌سازی: تریم، یکنواخت‌سازی فاصله، نیم‌فاصله، و تبدیل ي/ك به ی/ک
     */
    private function norm(string $s): string
    {
        // تبدیل عربی -> فارسی
        $s = str_replace(['ي', 'ك'], ['ی', 'ک'], $s);
        // تبدیل نیم‌فاصله و NBSP به فاصله معمولی
        $s = str_replace(["\u{200C}", "\u{00A0}"], ' ', $s);
        // تریم
        $s = trim($s);
        // یکی‌کردن فاصله‌های پشت هم
        $s = preg_replace('/\s+/u', ' ', $s);
        return $s;
    }
}
