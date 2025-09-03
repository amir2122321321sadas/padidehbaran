<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('checker_excels', function (Blueprint $table) {
            $table->id()->comment('ردیف');
            $table->string('policy_number')->comment('شماره بیمه نامه');
            $table->string('policy_type')->comment('نوع بیمه نامه');
            $table->string('contract')->nullable()->comment('قرارداد');
            $table->string('policyholder')->comment('بیمه گذار');
            $table->string('policyholder_national_id', 10)->comment('شماره ملی بیمه گذار');
            $table->string('policyholder_mobile', 15)->comment('تلفن همراه بیمه گذار');
            $table->string('insured')->comment('بیمه شده');
            $table->string('currency_unit', 10)->comment('واحد پولی');
            $table->string('issue_date')->comment('تاریخ صدور بیمه نامه');
            $table->string('start_date')->comment('تاریخ شروع');
            $table->string('end_date')->comment('تاریخ پایان');
            $table->string('issuing_unit')->comment('واحد صدور');
            $table->string('issuing_unit_code')->comment('کد واحد صدور');
            $table->string('issuing_province')->comment('استان واحد صدور');
            $table->string('issuing_city')->comment('شهر واحد صدور');
            $table->string('issuing_supervisor')->comment('ناظر واحد صدور');
            $table->string('issuing_supervisor_code')->comment('کد ناظر واحد صدور');
            $table->string('introducer')->nullable()->comment('معرف');
            $table->string('introducer_code')->nullable()->comment('کد معرف');
            $table->string('sales_org_code')->nullable()->comment('کد سازمان فروش');
            $table->string('sales_org_introducers')->nullable()->comment('معرف ها در سازمان فروش');
            $table->string('year_number')->comment('شماره سال');
            $table->string('installment_number')->comment('شماره قسط');
            $table->string('installment_due_date')->comment('تاریخ سررسید قسط');
            $table->string('installment_amount', )->comment('مبلغ قسط');
            $table->string('installment_balance')->comment('مانده قسط');
            $table->string('life_insurance_premium')->comment('حق بیمه عمر');
            $table->string('supplementary_insurance_premium')->comment('حق بیمه تکمیلی');
            $table->string('savings_amount')->comment('مبلغ پس انداز');
            $table->string('sales_cost')->comment('هزینه فروش');
            $table->string('collection_cost')->comment('هزینه وصول');
            $table->string('supplementary_commission')->comment('کارمزد پوشش تکمیلی');
            $table->string('administrative_cost')->comment('هزینه اداری');
            $table->string('insurance_cost')->comment('هزینه بیمه گری');
            $table->string('deposit_commission')->comment('کارمزد واریز اندوخته');
            $table->string('deposit_profit')->comment('سود سپرده');
            $table->string('identifier_code')->comment('کد شناسه');
            $table->string('payment_identifier')->nullable()->comment('شناسه پرداخت');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checker_excels');
    }
};
