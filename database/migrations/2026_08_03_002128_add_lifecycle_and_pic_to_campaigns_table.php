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
        Schema::table('campaigns', function (Blueprint $table) {
            // Masa berlaku campaign (default ±1 bulan diisi saat create)
            $table->date('starts_at')->nullable()->after('is_active');
            $table->date('ends_at')->nullable()->after('starts_at');
            // PIC yang bertanggung jawab — TIDAK tampil di web, hanya masuk email lead
            $table->string('pic_name')->nullable()->after('ends_at');
            $table->string('pic_phone')->nullable()->after('pic_name');
            $table->string('pic_email')->nullable()->after('pic_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['starts_at', 'ends_at', 'pic_name', 'pic_phone', 'pic_email']);
        });
    }
};
