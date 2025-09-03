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

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('web_name');
            $table->text('description');
            $table->text('about_we');
            $table->boolean('is_repair_mode');
            $table->dateTime('start_work_time');
            $table->dateTime('end_work_time');
            $table->text('phone');
            $table->text('favicon');
            $table->text('background_login_page');
            $table->text('simple_logo');
            $table->text('original_logo');
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
        Schema::dropIfExists('settings');
    }
};
