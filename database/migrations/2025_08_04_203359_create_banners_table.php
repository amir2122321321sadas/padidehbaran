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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('location');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('status');
            $table->text('url')->nullable();
            $table->text('image');
            $table->string('head_amazing_text')->nullable();
            $table->string('left_head_amazing_text')->nullable();
            $table->string('right_button_text_with_icon');
            $table->string('left_button_text_with_icon');
            $table->text('advantages_with_icon')->nullable();
           $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
