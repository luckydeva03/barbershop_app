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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('address');
            $table->string('phone', 20);
            $table->string('hours')->default('09:00 - 21:00');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order_sort')->default(0);
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes untuk performa
            $table->index(['is_active', 'order_sort']);
            $table->index(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
