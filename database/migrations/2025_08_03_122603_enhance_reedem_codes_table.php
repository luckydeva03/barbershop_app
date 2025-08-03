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
        Schema::table('reedem_codes', function (Blueprint $table) {
            $table->softDeletes();
            $table->timestamp('expires_at')->nullable();
            $table->text('description')->nullable();
            $table->integer('max_uses')->nullable();
            $table->integer('current_uses')->default(0);
            $table->index(['code', 'is_active']);
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reedem_codes', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn(['expires_at', 'description', 'max_uses', 'current_uses']);
            $table->dropIndex(['code', 'is_active']);
            $table->dropIndex(['expires_at']);
        });
    }
};
