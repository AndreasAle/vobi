<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::truncate();

        $posts = [
            [
                'title'    => 'Apa itu TAP System? Cara Kerja TikTok Affiliate Partner VOBI',
                'category' => 'Affiliate',
                'image'    => 'eco2',
                'read_min' => 5,
                'excerpt'  => 'TAP (TikTok Affiliate Partner) adalah sistem matchmaking VOBI yang mempertemukan seller dan creator, lengkap dengan product campaign untuk 6 kategori produk.',
                'body'     => <<<'HTML'
<p><strong>TAP System</strong> (TikTok Affiliate Partner) adalah layanan andalan VOBI MCN. Sederhananya, TAP adalah <em>jembatan</em> antara seller/brand yang punya produk, dan creator yang siap menjualnya lewat konten dan live streaming.</p>
<h2>Bagaimana cara kerjanya?</h2>
<p>VOBI menyediakan sistem matchmaking untuk kedua pihak &mdash; seller maupun creator &mdash; sekaligus membantu seller mendistribusikan dan mempromosikan produk lewat <strong>dedicated product campaign</strong>.</p>
<p>VOBI memiliki TAP dari berbagai kategori:</p>
<ul>
  <li>Beauty</li><li>Home Living</li><li>Mom &amp; Baby</li>
  <li>Fashion</li><li>Food &amp; Beverage</li><li>Electronic</li>
</ul>
<h2>Kenapa menguntungkan untuk creator?</h2>
<p>Kerjasama affiliate berbasis komisi (TAP) memberikan <strong>komisi yang lebih tinggi</strong> daripada komisi dasar. Talent juga mendapat <strong>sampel produk gratis</strong> yang jumlahnya disesuaikan dengan kemampuan dan jangkauan produk.</p>
<h2>Fleksibel untuk seller</h2>
<p>Brand/seller bisa <strong>mengkustomisasi campaign</strong> sesuai kebutuhan. Komisi yang diberikan ke creator lebih tinggi dari base commission, dan komisi untuk agency bersifat negotiable (minimum 5%).</p>
<p>Selain TAP, VOBI juga menyediakan skema <strong>Card Rate</strong> &mdash; kerjasama berbasis pembayaran untuk jasa live streaming/video pendek, mengacu pada performa GMV dan engagement talent.</p>
<p><em>Tertarik menjajal TAP untuk brand-mu? Jelajahi katalog talent kami di Campaign Marketplace.</em></p>
HTML,
            ],
            [
                'title'    => 'Kenapa UMKM Wajib Punya Website di Era Sekarang',
                'category' => 'Digital',
                'image'    => 'vobi-web',
                'read_min' => 4,
                'excerpt'  => 'Di era biaya digital dan potongan platform yang terus meningkat, memiliki website bukan lagi pilihan, melainkan kebutuhan. Kenali layanan Conversion Web SEAMEDIA.',
                'body'     => <<<'HTML'
<p>&ldquo;Di era biaya digital dan potongan platform yang terus meningkat, memiliki website bukan lagi pilihan, melainkan <strong>kebutuhan</strong>.&rdquo;</p>
<p>Banyak UMKM dan local brand sudah aktif di sosial media &mdash; tapi lupa bahwa traffic dan perhatian itu perlu diarahkan ke tempat yang <em>mereka miliki sendiri</em>. Di sinilah <strong>Conversion Web</strong> dari SEAMEDIA hadir.</p>
<h2>Dari konten menuju konversi nyata</h2>
<p>Kami membawa traffic dan awareness lewat konten, lalu menyediakan halaman profesional agar traffic bisa diarahkan ke <strong>katalog, WhatsApp, booking, dan penawaran bisnis</strong> yang menghasilkan.</p>
<h2>Kenapa penting punya website sendiri?</h2>
<ul>
  <li>Bisnis lebih <strong>terpercaya</strong> dan terlihat profesional.</li>
  <li>Lebih <strong>mandiri</strong> &mdash; tidak bergantung sepenuhnya pada marketplace.</li>
  <li>Bebas dari potongan platform yang terus naik.</li>
  <li>Punya katalog, landing page, hingga sistem pemesanan langsung.</li>
</ul>
<h2>Pilihan paket</h2>
<ul>
  <li><strong>Launch Package &mdash; Rp 1.250.000:</strong> website baru siap tayang, 7 halaman, dashboard admin basic, SEO basic.</li>
  <li><strong>Care Package &mdash; Rp 1.500.000:</strong> untuk yang sudah punya website dan ingin menjaga keberlangsungannya.</li>
  <li><strong>Signature Package &mdash; Custom:</strong> desain premium &amp; eksklusif dengan ciri khas tersendiri.</li>
</ul>
<p>Bukan sekadar aktif di sosial media &mdash; saatnya punya kehadiran digital yang profesional dengan konversi tinggi.</p>
HTML,
            ],
            [
                'title'    => 'Kisah Sukses Talent VOBI: Dari Live Sampai Ratusan Juta',
                'category' => 'Creator Tips',
                'image'    => 'blog1',
                'read_min' => 5,
                'excerpt'  => 'Konsistensi, kerja keras, dan dukungan tim. Inilah cerita talent VOBI yang menembus GMV ratusan juta hingga meraih award nasional.',
                'body'     => <<<'HTML'
<p>Di VOBI, kami percaya setiap talent punya potensi &mdash; yang dibutuhkan adalah <strong>pembinaan, panggung, dan rumah</strong> yang mendukung. Berikut beberapa cerita nyata dari keluarga VOBI.</p>
<h2>Kesya &mdash; Rp 600 juta dalam satu sesi live</h2>
<p>Talent fashion dengan performa tinggi dan konsisten. Berkat dukungan Tim VOBI, <strong>@kesyamartgorsir</strong> mampu meraih hingga <strong>Rp 600 juta dalam satu sesi live</strong>.</p>
<h2>Siswanto &mdash; Award Festival Beli Lokal Tokopedia</h2>
<p><strong>@siswanto146088</strong> antusias meningkatkan performanya. Ia melakukan live streaming 24 jam, bergantian dengan pasangannya. Lewat kerja keras dan dedikasi, Siswanto meraih <strong>Award dari Festival Beli Lokal by Tokopedia, Agustus 2024</strong>.</p>
<h2>Pertumbuhan GMV yang konsisten</h2>
<ul>
  <li><strong>@jajankhasindo99</strong> (F&amp;B) mencatat GMV hingga <strong>Rp 269.059.686</strong>.</li>
  <li><strong>@bakulankoe88</strong> menunjukkan pertumbuhan yang baik dengan GMV menembus <strong>Rp 101.509.011</strong>.</li>
</ul>
<h2>Apa rahasianya?</h2>
<p>Kami mengedukasi, melatih, dan memberi kesempatan bagi talent yang berdedikasi tinggi untuk tumbuh. Talent dari skala micro sampai mega diarahkan menjadi <strong>talent yang profesional dan menghibur</strong>. Karena di VOBI, kamu tidak berjuang sendirian.</p>
HTML,
            ],
            [
                'title'    => 'Viral vs Story Driven: Pilih Paket Konten yang Tepat',
                'category' => 'Marketing',
                'image'    => 'vobi-content',
                'read_min' => 4,
                'excerpt'  => 'SEAMEDIA punya dua pendekatan produksi konten. Viral Content untuk dampak cepat, Story Driven untuk branding jangka panjang. Mana yang cocok untukmu?',
                'body'     => <<<'HTML'
<p>Setiap brand punya tujuan berbeda. Karena itu, SEAMEDIA menghadirkan dua paket produksi konten dengan pendekatan yang berbeda.</p>
<h2>Paket 1 &mdash; Viral Content Production</h2>
<p>Fokus pada <strong>peningkatan reach, engagement, dan awareness dalam waktu relatif cepat</strong>, lewat format konten yang terbukti diminati audiens. Tim melakukan riset tren, format viral, hook, dan editing style yang sedang berkembang di TikTok dan Instagram &mdash; lalu diadaptasi ke karakter brand tanpa menghilangkan identitas produk.</p>
<ul>
  <li>Pilihan <strong>Host &amp; Live</strong> (fokus penjualan): 20 jam live/bulan, video shoppable, host &amp; operator.</li>
  <li>Pilihan <strong>Content Production</strong> (fokus impresi): 10 Reels/TikTok, 10 feed foto, content plan, riset SEO.</li>
  <li>Nilai investasi mulai dari <strong>Rp 2.000.000</strong>.</li>
</ul>
<h2>Paket 2 &mdash; Story Driven Production</h2>
<p>Fokus membangun <strong>identitas, karakter, dan hubungan emosional</strong> dengan audiens &mdash; agar brand tidak hanya bergantung pada promo atau tren. Lewat brand audit, brand direction, dan signature content, setiap konten dirancang agar konsisten, mudah dikenali, dan membangun loyalitas jangka panjang.</p>
<ul>
  <li>3 Signature Story Video + 7 Supporting Daily Video + 10 Feed Content.</li>
  <li>Brand Audit, Brand Direction, Story Telling Direction, Brand Development Consultant.</li>
  <li>Nilai investasi mulai dari <strong>Rp 3.000.000</strong>.</li>
</ul>
<h2>Jadi, pilih yang mana?</h2>
<p>Kalau kamu butuh <strong>dampak cepat</strong> &mdash; dorongan penjualan atau awareness &mdash; pilih <strong>Viral Content</strong>. Kalau kamu ingin membangun <strong>brand yang berkarakter dan loyalitas jangka panjang</strong>, <strong>Story Driven</strong> adalah jawabannya. Bingung? Tim kami siap bantu petakan lewat konsultasi gratis.</p>
HTML,
            ],
        ];

        $when = Carbon::now();
        foreach ($posts as $i => $p) {
            Post::create([
                'title'        => $p['title'],
                'slug'         => Str::slug($p['title']),
                'category'     => $p['category'],
                'excerpt'      => $p['excerpt'],
                'body'         => $p['body'],
                'image'        => $p['image'],
                'read_min'     => $p['read_min'],
                'is_published' => true,
                'published_at' => $when->copy()->subDays($i * 3),
            ]);
        }
    }
}
