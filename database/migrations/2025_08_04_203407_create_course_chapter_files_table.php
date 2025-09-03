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

        Schema::create('course_chapter_files', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('video');
            $table->text('cover');
            $table->foreignId('course_chapter_id')->references('id')->on('course_chapters')->onDelete('cascade');
            $table->bigInteger('total_time');
            $table->bigInteger('order');
            $table->tinyInteger('status');
            $table->json('access_levels')->nullable();
            $table->text('slug');
            $table->foreignid('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreignId('teacher_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('course_chapter_files');
    }
};
