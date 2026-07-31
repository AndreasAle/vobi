<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');                 // niche
            $table->string('service');                  // Video + Live, Affiliate, dll
            $table->string('creator_name')->nullable(); // kreator terkait (opsional)
            $table->unsignedBigInteger('price')->default(0);     // rupiah paket
            $table->text('sow')->nullable();            // scope of work
            $table->string('performance')->nullable();  // ringkas: "3,1x ROI"
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
