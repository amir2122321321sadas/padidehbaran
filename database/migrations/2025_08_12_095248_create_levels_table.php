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
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('order_level')->unique()->comment('ترتیب رتبه هر سطح با این فیلد تعیین میشود');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('icon')->nullable();
            $table->json('course_id')->comment('دوره هایی که کاربر به آنها در این سطح دسترسی خواهد داشت');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('levels');
    }
};
