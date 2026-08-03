@extends('layouts.app')

@section('title', 'Layanan & Harga — VOBI MCN & SEAMEDIA | VOBI Group')
@section('meta_description', 'Layanan lengkap VOBI Group: MCN & TikTok Affiliate (TAP), live streaming support (mulai Rp 200rb), product footage (Rp 150rb), Viral Content (Rp 2jt), Story Driven (Rp 3jt), dan Conversion Web (mulai Rp 1,25jt). Harga transparan.')
@section('og_title', 'Layanan & Paket VOBI Group — Harga Transparan')

@push('head')
<script type="application/ld+json">@php
    echo json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Layanan', 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp</script>
@endpush

@php
    $layPricing = setting_arr('lay_pricing', [
        ['unit' => 'VOBI MCN', 'title' => 'Live Streaming Support', 'price' => 'Rp 200rb / mulai', 'desc' => 'Studio + host profesional untuk memaksimalkan sesi live.', 'bullets' => [], 'hot' => false, 'cta_label' => 'Tanya Detail', 'cta_url' => route('kontak')],
        ['unit' => 'VOBI MCN', 'title' => 'Product Footage', 'price' => 'Rp 150rb / mulai', 'desc' => 'Footage videografi produk berkualitas, siap dipasarkan.', 'bullets' => [], 'hot' => false, 'cta_label' => 'Tanya Detail', 'cta_url' => route('kontak')],
        ['unit' => 'SEAMEDIA · Content', 'title' => 'Viral Content Production', 'price' => 'Rp 2jt / mulai', 'desc' => '', 'bullets' => ['Host & Live 20 jam/bln, atau', '10 Reels/TikTok + 10 feed foto', 'Content plan + riset SEO', 'Laporan insight bulanan'], 'hot' => true, 'cta_label' => 'Lihat Paket →', 'cta_url' => route('creator')],
        ['unit' => 'SEAMEDIA · Content', 'title' => 'Story Driven Production', 'price' => 'Rp 3jt / mulai', 'desc' => '', 'bullets' => ['3 signature story + 7 daily video', '10 feed content', 'Brand audit & direction', 'Konsultan brand development'], 'hot' => false, 'cta_label' => 'Tanya Detail', 'cta_url' => route('kontak')],
        ['unit' => 'Conversion Web', 'title' => 'Launch Package', 'price' => 'Rp 1,25jt', 'desc' => '', 'bullets' => ['Website/landing 7 halaman', 'Dashboard admin basic', 'SEO basic + siap di-index', 'WhatsApp funnel'], 'hot' => true, 'cta_label' => 'Pesan Website →', 'cta_url' => route('kontak')],
        ['unit' => 'Conversion Web', 'title' => 'Care Package', 'price' => 'Rp 1,5jt', 'desc' => 'Untuk yang sudah punya website — jaga keberlangsungan, update & dukungan teknis.', 'bullets' => [], 'hot' => false, 'cta_label' => 'Tanya Detail', 'cta_url' => route('kontak')],
        ['unit' => 'Conversion Web', 'title' => 'WA Funnel', 'price' => 'Rp 750rb', 'desc' => 'Landing page + tombol WhatsApp otomatis dengan format chat.', 'bullets' => [], 'hot' => false, 'cta_label' => 'Tanya Detail', 'cta_url' => route('kontak')],
        ['unit' => 'Conversion Web', 'title' => 'Signature Package', 'price' => 'Custom', 'desc' => 'Desain website premium & eksklusif dengan ciri khas unit bisnis.', 'bullets' => [], 'hot' => false, 'cta_label' => 'Konsultasi', 'cta_url' => route('kontak')],
    ]);
    $layProcess = setting_arr('lay_process', [
        ['title' => 'Discovery', 'desc' => 'Pahami tujuan, audiens, & skala kebutuhanmu.'],
        ['title' => 'Strategy', 'desc' => 'Petakan talent, platform, & paket yang pas.'],
        ['title' => 'Production', 'desc' => 'Eksekusi konten & live oleh tim berpengalaman.'],
        ['title' => 'Launch', 'desc' => 'Tayang, dipantau, dioptimasi real-time.'],
        ['title' => 'Report', 'desc' => 'Laporan insight & performa tiap bulan.'],
    ]);
@endphp

@section('body')

{{-- ===== Hero ===== --}}
<section class="svc-hero">
  <div class="wrap st">
    <nav class="crumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Beranda</a><span class="sep">/</span><span>Layanan</span></nav>
    <span class="eyebrow">{{ setting('lay_hero_eyebrow', 'Layanan & Harga') }}</span>
    <h1 class="disp">{!! flame_text(setting('lay_hero_title', 'Dua unit, *satu ekosistem*.')) !!}</h1>
    <p class="lead2">{{ setting('lay_hero_lead', 'VOBI MCN untuk talent, affiliate & live streaming TikTok. SEAMEDIA untuk produksi konten & website konversi. Semua dengan harga transparan.') }}</p>
    <div class="svc-cats">
      <a href="#mcn"><span class="n">01</span> VOBI MCN</a>
      <a href="#content"><span class="n">02</span> SEAMEDIA Content</a>
      <a href="#web"><span class="n">03</span> Conversion Web</a>
      <a href="#harga"><span class="n">Rp</span> Paket &amp; Harga</a>
    </div>
  </div>
</section>

{{-- ===== Sticky index + bento detail ===== --}}
<section style="padding:0">
  <div class="wrap">
    <div class="svc-layout">
      <aside class="svc-index st" id="svcIndex" aria-label="Kategori layanan">
        <div class="ih">Unit &amp; Layanan</div>
        <a href="#mcn" data-cat="mcn"><span class="n">01</span><span class="t">VOBI MCN</span></a>
        <a href="#content" data-cat="content"><span class="n">02</span><span class="t">SEAMEDIA Content</span></a>
        <a href="#web" data-cat="web"><span class="n">03</span><span class="t">Conversion Web</span></a>
      </aside>

      <div class="svc-detail">

        <div class="cat" id="mcn">
          <div class="ch rv"><span class="cn">01</span><div><h2>{{ setting('lay_cat1_title', 'VOBI MCN') }}</h2><p class="cp">{{ setting('lay_cat1_desc', 'Rumah bagi 600+ talent — dibina dari micro sampai mega-scale, lengkap dengan sistem affiliate & dukungan live.') }}</p></div></div>
          <div class="subx st">
            <div class="tx img"><div class="im" data-bg="eco1"></div><div class="il"><div class="k">Talent Management</div><div class="n">600+ talent</div></div></div>
            <div class="tx"><span class="b3">Inti</span><h3>MCN &amp; Creator Management</h3><p>Naungan, edukasi, &amp; pelatihan talent — dari micro sampai mega, jadi kreator profesional.</p></div>
            <div class="tx"><span class="b3">Unggulan</span><h3>TikTok Affiliate Partner (TAP)</h3><p>Matchmaking seller &amp; creator + product campaign. 6 kategori. Komisi di atas base, agency min 5%.</p></div>
            <div class="tx"><h3>Live Streaming Support</h3><p>Studio &amp; host profesional memaksimalkan waktu live.</p><div class="ptag"><small>Mulai dari</small>Rp 200.000</div></div>
            <div class="tx"><h3>Product Videography Footage</h3><p>Footage produk siap pasar untuk brand/seller.<span> &middot; Ads, Campaign &amp; Tracking tersedia.</span></p><div class="ptag"><small>Mulai dari</small>Rp 150.000</div></div>
          </div>
        </div>

        <div class="cat" id="content">
          <div class="ch rv"><span class="cn">02</span><div><h2>{{ setting('lay_cat2_title', 'SEAMEDIA · Content Creation') }}</h2><p class="cp">{{ setting('lay_cat2_desc', 'Konten promosi konsisten untuk awareness & penjualan — lewat strategi kreatif yang relevan dengan audiens.') }}</p></div></div>
          <div class="subx st mirror">
            <div class="tx img"><div class="im" data-bg="vobi-content"></div><div class="il"><div class="k">Content Creation</div><div class="n">4.000+ creator</div></div></div>
            <div class="tx"><span class="b3">Populer</span><h3>Viral Content Production</h3><p>Reach, engagement &amp; awareness cepat lewat format viral (TikTok/Instagram) yang diadaptasi ke brand.</p><div class="ptag"><small>Mulai dari</small>Rp 2.000.000</div></div>
            <div class="tx"><h3>Story Driven Production</h3><p>Bangun identitas &amp; hubungan emosional lewat storytelling &amp; signature content.</p><div class="ptag"><small>Mulai dari</small>Rp 3.000.000</div></div>
            <div class="tx"><h3>Host &amp; Live (Fokus Penjualan)</h3><p>20 jam live/bulan, video shoppable, design feed, host &amp; operator.</p></div>
            <div class="tx"><h3>Content Production (Fokus Impresi)</h3><p>10 Reels/TikTok, 10 feed foto, content plan, riset SEO, copywriting caption.</p></div>
          </div>
        </div>

        <div class="cat" id="web">
          <div class="ch rv"><span class="cn">03</span><div><h2>{{ setting('lay_cat3_title', 'Conversion Web') }}</h2><p class="cp">{{ setting('lay_cat3_desc', 'Dari konten menuju konversi nyata — website profesional, katalog, & landing page untuk UMKM & unit usaha.') }}</p></div></div>
          <div class="subx st">
            <div class="tx img"><div class="im" data-bg="vobi-web"></div><div class="il"><div class="k">Digital Website</div><div class="n">conweb.id</div></div></div>
            <div class="tx"><span class="b3">Launch</span><h3>Website Baru — Launch</h3><p>Website/landing 7 halaman, dashboard admin basic, SEO basic, siap tayang.</p><div class="ptag"><small>Paket</small>Rp 1.250.000</div></div>
            <div class="tx"><h3>Website — Care</h3><p>Untuk yang sudah punya website &amp; ingin jaga keberlangsungan + update.</p><div class="ptag"><small>Paket</small>Rp 1.500.000</div></div>
            <div class="tx"><h3>WA Funnel / Landing Page</h3><p>Landing + tombol WhatsApp otomatis dengan format chat.</p><div class="ptag"><small>Paket</small>Rp 750.000</div></div>
            <div class="tx"><span class="b3">Custom</span><h3>Signature Package + SEO</h3><p>Desain premium eksklusif &amp; SEO terkategori + Google Business Profile.</p></div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

{{-- ===== Paket & Harga ===== --}}
<section id="harga" style="border-top:1px solid var(--line-2)">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">{{ setting('lay_pricing_eyebrow', 'Paket & Investasi') }}</span><h2 class="disp">{{ setting('lay_pricing_title', 'Harga transparan.') }}</h2></div>
      <p class="r">{{ setting('lay_pricing_sub', 'Semua paket bisa dikustomisasi sesuai skala kebutuhanmu.') }}</p>
    </div>

    <div class="pricing st">
      @foreach ($layPricing as $pc)
        <div class="pcard {{ ($pc['hot'] ?? false) ? 'hot' : '' }}">
          <div class="pu">{{ $pc['unit'] ?? '' }}</div><div class="pt">{{ $pc['title'] ?? '' }}</div>
          <div class="pp">{{ $pc['price'] ?? '' }}</div>
          @if (!empty($pc['bullets']))
            <ul>@foreach ($pc['bullets'] as $bl)<li>{{ $bl }}</li>@endforeach</ul>
          @elseif (!empty($pc['desc']))
            <p class="pd">{{ $pc['desc'] }}</p>
          @endif
          <a class="btn {{ ($pc['hot'] ?? false) ? 'solid' : 'ghost' }}" href="{{ $pc['cta_url'] ?? route('kontak') }}"><span>{{ $pc['cta_label'] ?? 'Tanya Detail' }}</span></a>
        </div>
      @endforeach
    </div>

    <div class="rv" style="margin-top:34px">
      <div class="mk-fglabel" style="margin-bottom:12px">Add-on Conversion Web</div>
      <div class="addons">
        <span class="addon">Tambah Halaman <b>Rp 200rb</b></span>
        <span class="addon">Upload Produk <b>Rp 15rb</b>/produk</span>
        <span class="addon">Edit Konten Ringan <b>Rp 150rb</b></span>
        <span class="addon">Desain Banner <b>Rp 150rb</b>/banner</span>
        <span class="addon">Maintenance Bulanan <b>Rp 350rb</b>/bln</span>
        <span class="addon">SEO Terkategori + Google Business</span>
      </div>
    </div>
  </div>
</section>

{{-- ===== How we work (process) ===== --}}
<section style="border-top:1px solid var(--line-2)">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">{{ setting('lay_process_eyebrow', 'Cara Kerja') }}</span><h2 class="disp">{{ setting('lay_process_title', 'Lima langkah, tanpa ribet.') }}</h2></div>
      <p class="r">{{ setting('lay_process_sub', 'Alur transparan dari obrolan pertama sampai campaign menang.') }}</p>
    </div>
    <div class="process st">
      @foreach ($layProcess as $i => $ps)
        <div class="pstep"><div class="pn">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div><h4>{{ $ps['title'] ?? '' }}</h4><p>{{ $ps['desc'] ?? '' }}</p></div>
      @endforeach
    </div>
  </div>
</section>

{{-- ===== CTA ===== --}}
<section class="final">
  <div class="glow"></div>
  <div class="wrap">
    <span class="eyebrow rv" style="justify-content:center">{{ setting('lay_final_eyebrow', 'Butuh Bantuan?') }}</span>
    <h2 class="disp rv">{!! flame_text(setting('lay_final_title', 'Konsultasi *gratis* dulu.')) !!}</h2>
    <p class="rv">{{ setting('lay_final_text', 'Ceritakan kebutuhanmu — tim kami bantu petakan paket yang paling pas.') }}</p>
    <div class="hero-cta rv" style="justify-content:center">
      <a class="btn solid" href="{{ route('kontak') }}"><span>Konsultasi Gratis</span></a>
      <a class="btn ghost" href="{{ route('creator') }}"><span>Lihat Marketplace</span></a>
    </div>
  </div>
</section>

@push('scripts')
<script>
(function(){
  var index = document.getElementById('svcIndex');
  if(!index) return;
  var links = {};
  [].forEach.call(index.querySelectorAll('a[data-cat]'), function(a){ links[a.dataset.cat] = a; });
  var cats = [].slice.call(document.querySelectorAll('.cat'));
  var io = new IntersectionObserver(function(es){
    es.forEach(function(e){
      if(e.isIntersecting){
        Object.keys(links).forEach(function(k){ links[k].classList.remove('active'); });
        var a = links[e.target.id]; if(a) a.classList.add('active');
      }
    });
  }, { rootMargin: '-45% 0px -50% 0px', threshold: 0 });
  cats.forEach(function(c){ io.observe(c); });
  if(links.mcn) links.mcn.classList.add('active');
})();
</script>
@endpush

@endsection
