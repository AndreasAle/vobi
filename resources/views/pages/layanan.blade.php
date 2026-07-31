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

@section('body')

{{-- ===== Hero ===== --}}
<section class="svc-hero">
  <div class="wrap st">
    <nav class="crumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Beranda</a><span class="sep">/</span><span>Layanan</span></nav>
    <span class="eyebrow">Layanan &amp; Harga</span>
    <h1 class="disp">Dua unit, <span class="flame">satu ekosistem</span>.</h1>
    <p class="lead2">VOBI MCN untuk talent, affiliate &amp; live streaming TikTok. SEAMEDIA untuk produksi konten &amp; website konversi. Semua dengan harga transparan.</p>
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
          <div class="ch rv"><span class="cn">01</span><div><h2>VOBI MCN</h2><p class="cp">Rumah bagi 600+ talent — dibina dari micro sampai mega-scale, lengkap dengan sistem affiliate &amp; dukungan live.</p></div></div>
          <div class="subx st">
            <div class="tx img"><div class="im" data-bg="eco1"></div><div class="il"><div class="k">Talent Management</div><div class="n">600+ talent</div></div></div>
            <div class="tx"><span class="b3">Inti</span><h3>MCN &amp; Creator Management</h3><p>Naungan, edukasi, &amp; pelatihan talent — dari micro sampai mega, jadi kreator profesional.</p></div>
            <div class="tx"><span class="b3">Unggulan</span><h3>TikTok Affiliate Partner (TAP)</h3><p>Matchmaking seller &amp; creator + product campaign. 6 kategori. Komisi di atas base, agency min 5%.</p></div>
            <div class="tx"><h3>Live Streaming Support</h3><p>Studio &amp; host profesional memaksimalkan waktu live.</p><div class="ptag"><small>Mulai dari</small>Rp 200.000</div></div>
            <div class="tx"><h3>Product Videography Footage</h3><p>Footage produk siap pasar untuk brand/seller.<span> &middot; Ads, Campaign &amp; Tracking tersedia.</span></p><div class="ptag"><small>Mulai dari</small>Rp 150.000</div></div>
          </div>
        </div>

        <div class="cat" id="content">
          <div class="ch rv"><span class="cn">02</span><div><h2>SEAMEDIA &middot; Content Creation</h2><p class="cp">Konten promosi konsisten untuk awareness &amp; penjualan — lewat strategi kreatif yang relevan dengan audiens.</p></div></div>
          <div class="subx st mirror">
            <div class="tx img"><div class="im" data-bg="vobi-content"></div><div class="il"><div class="k">Content Creation</div><div class="n">4.000+ creator</div></div></div>
            <div class="tx"><span class="b3">Populer</span><h3>Viral Content Production</h3><p>Reach, engagement &amp; awareness cepat lewat format viral (TikTok/Instagram) yang diadaptasi ke brand.</p><div class="ptag"><small>Mulai dari</small>Rp 2.000.000</div></div>
            <div class="tx"><h3>Story Driven Production</h3><p>Bangun identitas &amp; hubungan emosional lewat storytelling &amp; signature content.</p><div class="ptag"><small>Mulai dari</small>Rp 3.000.000</div></div>
            <div class="tx"><h3>Host &amp; Live (Fokus Penjualan)</h3><p>20 jam live/bulan, video shoppable, design feed, host &amp; operator.</p></div>
            <div class="tx"><h3>Content Production (Fokus Impresi)</h3><p>10 Reels/TikTok, 10 feed foto, content plan, riset SEO, copywriting caption.</p></div>
          </div>
        </div>

        <div class="cat" id="web">
          <div class="ch rv"><span class="cn">03</span><div><h2>Conversion Web</h2><p class="cp">Dari konten menuju konversi nyata — website profesional, katalog, &amp; landing page untuk UMKM &amp; unit usaha.</p></div></div>
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
      <div><span class="eyebrow">Paket &amp; Investasi</span><h2 class="disp">Harga transparan.</h2></div>
      <p class="r">Semua paket bisa dikustomisasi sesuai skala kebutuhanmu.</p>
    </div>

    <div class="pricing st">
      <div class="pcard">
        <div class="pu">VOBI MCN</div><div class="pt">Live Streaming Support</div>
        <div class="pp">Rp 200<small>rb / mulai</small></div>
        <p class="pd">Studio + host profesional untuk memaksimalkan sesi live.</p>
        <a class="btn ghost" href="{{ route('kontak') }}"><span>Tanya Detail</span></a>
      </div>
      <div class="pcard">
        <div class="pu">VOBI MCN</div><div class="pt">Product Footage</div>
        <div class="pp">Rp 150<small>rb / mulai</small></div>
        <p class="pd">Footage videografi produk berkualitas, siap dipasarkan.</p>
        <a class="btn ghost" href="{{ route('kontak') }}"><span>Tanya Detail</span></a>
      </div>
      <div class="pcard hot">
        <div class="pu">SEAMEDIA &middot; Content</div><div class="pt">Viral Content Production</div>
        <div class="pp">Rp 2<small>jt / mulai</small></div>
        <ul><li>Host &amp; Live 20 jam/bln, atau</li><li>10 Reels/TikTok + 10 feed foto</li><li>Content plan + riset SEO</li><li>Laporan insight bulanan</li></ul>
        <a class="btn solid" href="{{ route('creator') }}"><span>Lihat Paket &rarr;</span></a>
      </div>
      <div class="pcard">
        <div class="pu">SEAMEDIA &middot; Content</div><div class="pt">Story Driven Production</div>
        <div class="pp">Rp 3<small>jt / mulai</small></div>
        <ul><li>3 signature story + 7 daily video</li><li>10 feed content</li><li>Brand audit &amp; direction</li><li>Konsultan brand development</li></ul>
        <a class="btn ghost" href="{{ route('kontak') }}"><span>Tanya Detail</span></a>
      </div>
      <div class="pcard hot">
        <div class="pu">Conversion Web</div><div class="pt">Launch Package</div>
        <div class="pp">Rp 1,25<small>jt</small></div>
        <ul><li>Website/landing 7 halaman</li><li>Dashboard admin basic</li><li>SEO basic + siap di-index</li><li>WhatsApp funnel</li></ul>
        <a class="btn solid" href="{{ route('kontak') }}"><span>Pesan Website &rarr;</span></a>
      </div>
      <div class="pcard">
        <div class="pu">Conversion Web</div><div class="pt">Care Package</div>
        <div class="pp">Rp 1,5<small>jt</small></div>
        <p class="pd">Untuk yang sudah punya website — jaga keberlangsungan, update &amp; dukungan teknis.</p>
        <a class="btn ghost" href="{{ route('kontak') }}"><span>Tanya Detail</span></a>
      </div>
      <div class="pcard">
        <div class="pu">Conversion Web</div><div class="pt">WA Funnel</div>
        <div class="pp">Rp 750<small>rb</small></div>
        <p class="pd">Landing page + tombol WhatsApp otomatis dengan format chat.</p>
        <a class="btn ghost" href="{{ route('kontak') }}"><span>Tanya Detail</span></a>
      </div>
      <div class="pcard">
        <div class="pu">Conversion Web</div><div class="pt">Signature Package</div>
        <div class="pp">Custom</div>
        <p class="pd">Desain website premium &amp; eksklusif dengan ciri khas unit bisnis.</p>
        <a class="btn ghost" href="{{ route('kontak') }}"><span>Konsultasi</span></a>
      </div>
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
      <div><span class="eyebrow">Cara Kerja</span><h2 class="disp">Lima langkah, tanpa ribet.</h2></div>
      <p class="r">Alur transparan dari obrolan pertama sampai campaign menang.</p>
    </div>
    <div class="process st">
      <div class="pstep"><div class="pn">01</div><h4>Discovery</h4><p>Pahami tujuan, audiens, &amp; skala kebutuhanmu.</p></div>
      <div class="pstep"><div class="pn">02</div><h4>Strategy</h4><p>Petakan talent, platform, &amp; paket yang pas.</p></div>
      <div class="pstep"><div class="pn">03</div><h4>Production</h4><p>Eksekusi konten &amp; live oleh tim berpengalaman.</p></div>
      <div class="pstep"><div class="pn">04</div><h4>Launch</h4><p>Tayang, dipantau, dioptimasi real-time.</p></div>
      <div class="pstep"><div class="pn">05</div><h4>Report</h4><p>Laporan insight &amp; performa tiap bulan.</p></div>
    </div>
  </div>
</section>

{{-- ===== CTA ===== --}}
<section class="final">
  <div class="glow"></div>
  <div class="wrap">
    <span class="eyebrow rv" style="justify-content:center">Butuh Bantuan?</span>
    <h2 class="disp rv">Konsultasi <span class="flame">gratis</span> dulu.</h2>
    <p class="rv">Ceritakan kebutuhanmu — tim kami bantu petakan paket yang paling pas.</p>
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
