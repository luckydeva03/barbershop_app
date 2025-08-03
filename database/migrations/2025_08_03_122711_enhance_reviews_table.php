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
        Schema::table('reviews', function (Blueprint $table) {
            $table->softDeletes();
            $table->integer('rating')->nullable();
            $table->string('title')->nullable();
            $table->index(['is_approved', 'rating']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn(['rating', 'title']);
            $table->dropIndex(['is_approved', 'rating']);
        });
    }
};
