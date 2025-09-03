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
        Schema::create('user_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('national_code')->unique();
            $table->string('birth_certificate_number')->nullable()->comment('شماره شناسنامه');
            $table->date('date_of_birth')->nullable()->comment('تاریخ تولد');
            $table->bigInteger('phone')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('address')->nullable();
            $table->foreignId('identification_code')->references('id')->on('users')->comment('کد معرف استفاده شده برای ثبت نام کاربر');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_information');
    }
};
