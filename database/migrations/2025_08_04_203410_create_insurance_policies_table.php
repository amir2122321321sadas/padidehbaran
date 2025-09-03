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
        Schema::disableForeignKeyConstraints();

        Schema::create('insurance_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->json('images')->comment('تصویر بیمه نامه');
            $table->string('insurance_policies_number' ,255)->comment('شماره بیمه نامه');
            $table->date('date_of_issue')->comment('تاریخ صدور بیمه نامه');
            $table->tinyInteger('type_insurance_policies')->comment('نوع بیمه نامه');
            $table->tinyInteger('installment_type')->comment('نوع اقساط بیمه نامه');
            $table->bigInteger('amount_of_each_installment')->comment('مبلغ هرقسط');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_policies');
    }
};
