<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin default (untuk admin panel nanti) — hanya dibuat jika belum ada
        User::firstOrCreate(
            ['email' => 'admin@vobi.id'],
            ['name' => 'VOBI Admin', 'password' => bcrypt('vobi-admin-2024')]
        );

        $this->call([
            MarketplaceSeeder::class,   // kreator + campaign/paket
            PostSeeder::class,          // artikel blog
        ]);
    }
}
