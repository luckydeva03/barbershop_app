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
        Schema::table('history_points', function (Blueprint $table) {
            $table->softDeletes();
            $table->text('description')->nullable();
            $table->index(['user_id', 'type']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('history_points', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn('description');
            $table->dropIndex(['user_id', 'type']);
            $table->dropIndex(['created_at']);
        });
    }
};
