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

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('summary_description');
            $table->text('description');
            $table->text('image');
            $table->bigInteger('total_files');
            $table->bigInteger('total_time');
            $table->tinyInteger('status');
            $table->string('them_color');
            $table->foreignid('category_id')->references('id')->on('course_categories')->onDelete('cascade');
            $table->foreignId('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('slug');
            $table->date('published_at');
            $table->json('access_levels')->nullable();
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
        Schema::dropIfExists('courses');
    }
};
