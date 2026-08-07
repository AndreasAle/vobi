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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('unit')->nullable();          // VOBI MCN, SEAMEDIA, dll
            $table->string('location')->nullable();       // Palembang / Remote
            $table->string('type')->default('Full-time'); // Full-time, Part-time, Magang, Freelance
            $table->string('arrangement')->nullable();    // Onsite / Remote / Hybrid
            $table->string('excerpt', 400)->nullable();
            $table->longText('description')->nullable();   // HTML (RichEditor)
            $table->json('requirements')->nullable();      // list poin kualifikasi
            $table->string('apply_wa')->nullable();        // nomor WA lamaran (opsional)
            $table->string('apply_email')->nullable();     // email lamaran (opsional)
            $table->boolean('is_open')->default(true);
            $table->date('posted_at')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
