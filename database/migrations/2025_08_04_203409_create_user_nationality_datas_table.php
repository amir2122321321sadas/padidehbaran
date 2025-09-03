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

        Schema::create('user_nationality_datas', function (Blueprint $table) {
            $table->id();
            $table->text('image_national_card')->comment('تصویر کارت ملی');
            $table->text('birth_certificate')->comment('تصویر شناسنامه');
            $table->text('face_image')->comment('تصویر 3*4 صورت کاربر');
            $table->text('image_educational_qualification')->comment('تصویر مدرک تحصیلی کاربر');
            $table->string('card_number')->comment('شماره کارت کاربر');
            $table->text('shaba_number')->comment('شماره شبا کاربر');
            $table->text('image_promissory_note')->comment('تصویر سفته با مبلغ از قبل گفته شده');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_nationality_datas');
    }
};
