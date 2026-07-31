<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('creators', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('handle')->nullable();      // @username
            $table->string('category');                 // Beauty, Fashion, F&B, ...
            $table->string('platform');                 // TikTok, Shopee, YouTube
            $table->string('city')->nullable();
            $table->unsignedBigInteger('followers')->default(0);
            $table->decimal('engagement_rate', 5, 2)->default(0);  // %
            $table->unsignedBigInteger('gmv_3m')->default(0);      // rupiah, 3 bulan
            $table->unsignedBigInteger('price_from')->default(0);  // rupiah
            $table->string('avatar')->nullable();       // image file in /images
            $table->text('sow')->nullable();            // ringkasan SOW / deliverables
            $table->text('bio')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('creators');
    }
};
