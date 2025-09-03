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

        Schema::create('user_views', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('total_time');
            $table->foreignid('course_id')->nullable()->references('id')->on('courses')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('course_file_id')->nullable()->references('id')->on('course_chapter_files')->onDelete('cascade');
            $table->text('page_link');
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
        Schema::dropIfExists('user_vews');
    }
};
