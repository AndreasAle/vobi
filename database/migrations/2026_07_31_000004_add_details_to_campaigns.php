<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('title');
            $table->json('details')->nullable()->after('sow');   // grup deliverables
            $table->string('note')->nullable()->after('details');
            $table->json('highlights')->nullable()->after('note'); // poin unggulan
        });
    }

    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropColumn(['subtitle', 'details', 'note', 'highlights']);
        });
    }
};
