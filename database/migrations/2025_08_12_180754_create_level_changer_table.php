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
        Schema::create('level_changer', function (Blueprint $table) {
            $table->id();
            $table->string('insurance_policies_number');
            $table->string('subtotal_number');
            $table->tinyInteger('status')->default(0);
            $table->foreignId('level_id')->nullable()->comment('سطحی که به آن تغییر خواهد کرد')->references('id')->on('levels')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_changer');
    }
};
