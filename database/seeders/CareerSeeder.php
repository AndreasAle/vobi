<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            [
                'title' => 'Talent Manager',
                'unit' => 'VOBI MCN',
                'location' => 'Palembang',
                'type' => 'Full-time',
                'arrangement' => 'Onsite',
                'excerpt' => 'Membina & mengembangkan talent dari micro sampai mega — jadi partner tumbuh para creator.',
                'description' => '<p>Sebagai Talent Manager, kamu jadi garda depan yang membina creator VOBI: dari onboarding, pendampingan konten, sampai strategi pertumbuhan.</p><p>Kamu akan bekerja dekat dengan tim produksi & affiliate untuk memastikan setiap talent berkembang optimal.</p>',
                'requirements' => [
                    ['item' => 'Komunikatif & suka membina orang'],
                    ['item' => 'Paham ekosistem TikTok/Shopee affiliate'],
                    ['item' => 'Terorganisir & bisa handle banyak talent'],
                    ['item' => 'Pengalaman di MCN/agency jadi nilai plus'],
                ],
                'sort' => 1,
            ],
            [
                'title' => 'Content Creator / Videographer',
                'unit' => 'SEAMEDIA',
                'location' => 'Palembang',
                'type' => 'Full-time',
                'arrangement' => 'Onsite',
                'excerpt' => 'Produksi konten viral & story-driven untuk brand — dari ide, shooting, sampai editing.',
                'description' => '<p>Kami cari kreator visual yang bisa menerjemahkan brief brand jadi konten yang nendang di TikTok & Instagram.</p><p>Kamu akan pegang produksi dari konsep, shooting, sampai editing akhir.</p>',
                'requirements' => [
                    ['item' => 'Mahir editing (CapCut/Premiere/After Effects)'],
                    ['item' => 'Punya sense visual & paham tren konten'],
                    ['item' => 'Bisa shooting mandiri'],
                    ['item' => 'Portofolio wajib dilampirkan'],
                ],
                'sort' => 2,
            ],
            [
                'title' => 'Live Streaming Host',
                'unit' => 'VOBI MCN',
                'location' => 'Palembang',
                'type' => 'Freelance',
                'arrangement' => 'Onsite',
                'excerpt' => 'Jadi host live yang menghibur & jago closing — bantu brand jualan lewat live.',
                'description' => '<p>Suka tampil & ngomong di depan kamera? Jadi host live VOBI dan bantu brand memaksimalkan penjualan lewat sesi live streaming.</p>',
                'requirements' => [
                    ['item' => 'Percaya diri & energik di depan kamera'],
                    ['item' => 'Komunikasi lancar & persuasif'],
                    ['item' => 'Fleksibel dengan jadwal live'],
                    ['item' => 'Pemula dipersilakan — kami bimbing'],
                ],
                'sort' => 3,
            ],
        ];

        foreach ($jobs as $job) {
            $job['slug'] = Str::slug($job['title']);
            $job['is_open'] = true;
            $job['posted_at'] = now();
            Career::firstOrCreate(['slug' => $job['slug']], $job);
        }
    }
}
