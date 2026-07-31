@extends('layouts.app')

@section('title', 'VOBI — Talent Agency & Creator Economy untuk Brand & Kreator')
@section('meta_description', 'VOBI Group: rumah bertumbuh untuk brand dan kreator. Layanan affiliate TikTok & Shopee, produksi konten, live streaming, video content, dan Campaign Marketplace. 12.000+ kreator aktif di 7 kota Indonesia.')

@section('body')
@verbatim
<!-- HERO — full-bleed background video -->
<section class="hero" id="top">
  <video class="hero-vid" data-vid="hero" autoplay muted loop playsinline preload="auto"></video>
  <div class="wrap">
    <div class="hero-copy">
      <div class="hero-eyebrow">Talent Agency <span>/</span> Creator Economy</div>
      <h1 class="disp">
        <span class="l"><span>A Home That</span></span>
        <span class="l"><span class="flame">Changes</span></span>
        <span class="l"><span>Everything.</span></span>
      </h1>
      <div class="sub-row">
        <span class="sub-bar"></span>
        <p class="sub">Rumah bagi <b>talent</b> &amp; <b>brand</b> — <b>VOBI MCN</b> untuk affiliate &amp; live TikTok, <b>SEAMEDIA</b> untuk konten &amp; website konversi.</p>
      </div>
    </div>
    <div class="hero-shelf">
      <div class="shelf-head"><span class="sh-label">Layanan Kami</span><span class="sh-line"></span><span class="sh-hint">geser untuk lihat &rarr;</span></div>
      <div class="svc-strip" id="svcstrip">
        <div class="svc-card" style="--c:#3B2E6E"><div class="pic" data-bg="eco1"></div><span class="arrow">&#8599;</span><div class="t">MCN Management</div><div class="tag2">VOBI MCN</div></div>
        <div class="svc-card" style="--c:#1F5D52"><div class="pic" data-bg="eco2"></div><span class="arrow">&#8599;</span><div class="t">TikTok Affiliate (TAP)</div><div class="tag2">VOBI MCN</div></div>
        <div class="svc-card" style="--c:#5B4A7A"><div class="pic" data-bg="succ3"></div><span class="arrow">&#8599;</span><div class="t">Live Streaming Support</div><div class="tag2">VOBI MCN</div></div>
        <div class="svc-card" style="--c:#2E3B73"><div class="pic" data-bg="vobi-beauty"></div><span class="arrow">&#8599;</span><div class="t">Product Footage</div><div class="tag2">VOBI MCN</div></div>
        <div class="svc-card" style="--c:#B05A32"><div class="pic" data-bg="vobi-content"></div><span class="arrow">&#8599;</span><div class="t">Viral Content</div><div class="tag2">SEAMEDIA</div></div>
        <div class="svc-card" style="--c:#276674"><div class="pic" data-bg="vobi-event"></div><span class="arrow">&#8599;</span><div class="t">Story Driven</div><div class="tag2">SEAMEDIA</div></div>
        <div class="svc-card" style="--c:#7A3560"><div class="pic" data-bg="vobi-web"></div><span class="arrow">&#8599;</span><div class="t">Conversion Web</div><div class="tag2">SEAMEDIA</div></div>
        <div class="svc-card" style="--c:#8A3B57"><div class="pic" data-bg="succ2"></div><span class="arrow">&#8599;</span><div class="t">WA Funnel</div><div class="tag2">SEAMEDIA</div></div>
        <div class="svc-card" style="--c:#2B4E86"><div class="pic" data-bg="eco3"></div><span class="arrow">&#8599;</span><div class="t">Ads &amp; Tracking</div><div class="tag2">VOBI MCN</div></div>
        <div class="svc-card" style="--c:#6B4A2A"><div class="pic" data-bg="eco4"></div><span class="arrow">&#8599;</span><div class="t">SEO &amp; Optimasi</div><div class="tag2">SEAMEDIA</div></div>
      </div>
    </div>
  </div>
</section>

<!-- BRAND WALL -->
<section class="brands" id="brands">
  <div class="wrap bhead rv">
    <span class="eyebrow" style="justify-content:center">Dipercaya Oleh</span>
    <h2>Brand ternama yang tumbuh bersama kami.</h2>
  </div>
  <div class="brow">
    <div class="btrack l">
      <div class="blogo"><b class="w-round">Rinso</b></div>
      <div class="blogo"><b class="w-ital">Unilever</b></div>
      <div class="blogo"><b class="w-caps">L'Oréal Paris</b></div>
      <div class="blogo"><b class="w-caps">Listerine</b></div>
      <div class="blogo"><b class="w-serif">Neutrogena</b></div>
      <div class="blogo"><b class="w-caps">Blackmores</b></div>
      <div class="blogo"><b class="w-light">Y.O.U</b></div>
      <div class="blogo"><b class="w-round">Baseus</b></div>
      <div class="blogo"><b class="w-ital">Madame Gie</b></div>
      <div class="blogo"><b class="w-serif">Aveeno</b></div>
    </div>
  </div>
  <div class="brow" style="margin-top:16px">
    <div class="btrack r">
      <div class="blogo"><b class="w-caps">Anlene</b></div>
      <div class="blogo"><b class="w-round">Robot</b></div>
      <div class="blogo"><b class="w-serif">Grandville</b></div>
      <div class="blogo"><b class="w-round">Mom Uung</b></div>
      <div class="blogo"><b class="w-caps">Anmum</b></div>
      <div class="blogo"><b class="w-round">Mixio</b></div>
      <div class="blogo"><b class="w-caps">Greney</b></div>
      <div class="blogo"><b class="w-serif">Moell</b></div>
      <div class="blogo"><b class="w-caps">TKIS</b></div>
      <div class="blogo"><b class="w-light">Revita</b></div>
    </div>
  </div>
</section>

<!-- TICKER -->
<div class="ticker"><div class="track" id="track">
  <div class="it"><b>TikTok</b><span class="dot"></span><b>Shopee</b><span class="dot"></span><b>Lazada</b><span class="dot"></span><b>YouTube</b><span class="dot"></span>Palembang<span class="dot"></span>Jakarta<span class="dot"></span>Bandung<span class="dot"></span>Jogja<span class="dot"></span>Bali<span class="dot"></span>Lampung<span class="dot"></span>Jambi<span class="dot"></span></div>
</div></div>

<!-- PERFORMANCE -->
<section id="perf">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">Performance Overview</span><h2 class="disp">Angka yang bicara.</h2></div>
      <p class="r">Rekap gabungan ekosistem VOBI Group — VOBI MCN &amp; SEAMEDIA.</p>
    </div>
    <div class="stats st">
      <div class="stat feat"><span class="tick">/ 01</span>
        <svg class="spark" width="120" height="40" viewBox="0 0 120 40" fill="none"><polyline points="0,34 20,28 40,30 60,18 80,20 100,8 120,4" stroke="url(#lg)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><defs><linearGradient id="lg" x1="0" y1="0" x2="120" y2="0"><stop stop-color="#D98A44"/><stop offset="1" stop-color="#E2C186"/></linearGradient></defs></svg>
        <div class="n tnum flame" data-pre="Rp " data-c="600" data-suf="Jt">0</div><div class="l">GMV per Sesi Live (talent terbaik)</div></div>
      <div class="stat tall"><span class="tick">/ 02</span>
        <svg class="ring" width="46" height="46" viewBox="0 0 46 46"><circle cx="23" cy="23" r="19" stroke="rgba(255,255,255,.12)" stroke-width="3" fill="none"/><circle cx="23" cy="23" r="19" stroke="var(--f2)" stroke-width="3" fill="none" stroke-linecap="round" stroke-dasharray="119" stroke-dashoffset="26" transform="rotate(-90 23 23)"/></svg>
        <div class="n tnum chrome" data-c="4600" data-suf="+">0</div><div class="l">Talent &amp; Creator</div></div>
      <div class="stat"><span class="tick">/ 03</span><div class="n tnum chrome" data-c="800" data-suf="+">0</div><div class="l">Brand &amp; Seller Partner</div></div>
      <div class="stat"><span class="tick">/ 04</span><div class="n tnum chrome" data-c="2000" data-suf="+">0</div><div class="l">Product Collaboration</div></div>
      <div class="stat wimg wide"><div class="bgimg" data-bg="vobi-beauty"></div><span class="tick">/ 05</span><div class="n tnum chrome" data-c="6" data-suf="">0</div><div class="l">Kategori Produk · Beauty, Fashion, F&amp;B, Home Living, Mom &amp; Baby, Electronic</div></div>
      <div class="stat wide"><span class="tick">/ 06</span><div class="n chrome">Official Partner</div><div class="l">TikTok · Shopee · Tokopedia</div></div>
    </div>
  </div>
</section>

<!-- ECOSYSTEM BENTO -->
<section id="eco">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">Business Ecosystem</span><h2 class="disp">Empat pilar,<br>satu rumah.</h2></div>
      <p class="r">Tiap unit punya fokus sendiri. Klik untuk kenal lebih dalam.</p>
    </div>
    <div class="eco2" id="eco2">
      <div class="epar feat" style="--h:540px;--o:0">
        <a class="ecard big" href="{{ route('ekosistem') }}"><div class="eimg" data-bg="eco1"></div><span class="enum">01</span><span class="ego">↗</span>
          <div class="ebody"><span class="etag">Talent & Creator Management</span><div class="en">VOBI MCN</div>
            <p class="edesc">Rumah bagi 600+ talent, dari micro sampai mega-scale — dibina, dilatih, dan diberi panggung.</p></div>
        </a>
      </div>
      <div class="epar" style="--h:430px;--o:66px">
        <a class="ecard" href="{{ route('layanan') }}"><div class="eimg" data-bg="eco2"></div><span class="enum">02</span><span class="ego">↗</span>
          <div class="ebody"><span class="etag">TikTok Affiliate Partner</span><div class="en">TAP System</div>
            <p class="edesc">Matchmaking seller &amp; creator + product campaign, 6 kategori produk.</p></div>
        </a>
      </div>
      <div class="epar" style="--h:400px;--o:26px">
        <a class="ecard" href="{{ route('layanan') }}"><div class="eimg" data-bg="vobi-content"></div><span class="enum">03</span><span class="ego">↗</span>
          <div class="ebody"><span class="etag">Content Creation</span><div class="en">SEAMEDIA</div>
            <p class="edesc">Produksi konten &amp; live streaming untuk brand dan UMKM.</p></div>
        </a>
      </div>
      <div class="epar" style="--h:468px;--o:100px">
        <a class="ecard" href="{{ route('creator') }}"><div class="eimg" data-bg="vobi-web"></div><span class="enum">04</span><span class="ego">↗</span>
          <div class="ebody"><span class="etag">Conversion Web</span><div class="en">SEAMEDIA</div>
            <p class="edesc">Website profesional, katalog, &amp; landing page konversi tinggi untuk UMKM.</p></div>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- PAPER: CARA GABUNG (light) -->
<section class="paper" id="join">
  <div class="wrap paper-grid">
    <div class="shot rv" data-bg="story"></div>
    <div>
      <span class="eyebrow rv">Cara Gabung</span>
      <h2 class="disp rv">Dari kenalan<br>sampai cuan.</h2>
      <p class="lead rv">Tiga langkah. Simpel, transparan.</p>
      <div class="steps st">
        <div class="step"><div class="no flame">01</div><div><h3>Kenalan &amp; Strategi</h3></div></div>
        <div class="step"><div class="no flame">02</div><div><h3>Eksekusi &amp; Produksi</h3></div></div>
        <div class="step"><div class="no flame">03</div><div><h3>Tumbuh &amp; Skala</h3></div></div>
      </div>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section id="services">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">What We Do</span><h2 class="disp">Layanan penuh, ujung ke ujung.</h2></div>
      <p class="r">Dari creator economy sampai produk digital — semua di bawah satu atap.</p>
    </div>
    <div class="srv st">
      <div class="srv-row" data-h><span class="idx">(01)</span><h3>Creator Economy</h3><span class="tags">MCN · Affiliate · Campaign</span><span class="arr">↗</span></div>
      <div class="srv-row" data-h><span class="idx">(02)</span><h3>Content Production</h3><span class="tags">Photography · Videography · Livestream</span><span class="arr">↗</span></div>
      <div class="srv-row" data-h><span class="idx">(03)</span><h3>Digital</h3><span class="tags">Website · Landing Page · SEO · Maintenance</span><span class="arr">↗</span></div>
      <div class="srv-row" data-h><span class="idx">(04)</span><h3>Social Media</h3><span class="tags">Management · Strategy · Monthly Content · Ads</span><span class="arr">↗</span></div>
    </div>
  </div>
</section>

<!-- MARKETPLACE -->
<section id="mkt">
  <div class="wrap">
    <div class="mkt-head rv"><h2>Campaign <span class="flame">Marketplace</span></h2></div>
    <div class="fanreveal rv">
      <div class="fan">
        <div class="slot left"><div class="vcard">
          <video data-vid="card3" autoplay muted loop playsinline preload="auto"></video>
          <div class="badge2">Mid</div>
          <div class="vinfo"><div class="nm">Bagas Prawira</div><div class="ni">Tech · Gadget</div>
            <div class="gmv"><span class="v tnum">Rp 52Jt</span><span class="k">GMV / 3bln</span></div></div>
        </div></div>
        <div class="slot right"><div class="vcard">
          <video data-vid="card2" autoplay muted loop playsinline preload="auto"></video>
          <div class="badge2">Macro</div>
          <div class="vinfo"><div class="nm">Damar Aji</div><div class="ni">Lifestyle · Fashion</div>
            <div class="gmv"><span class="v tnum">Rp 96Jt</span><span class="k">GMV / 3bln</span></div></div>
        </div></div>
        <div class="slot center"><div class="vcard">
          <video data-vid="card1" autoplay muted loop playsinline preload="auto"></video>
          <div class="badge2">Macro</div>
          <div class="vinfo"><div class="nm">Rangga Satria</div><div class="ni">Beauty · Skincare</div>
            <div class="gmv"><span class="v tnum">Rp 84Jt</span><span class="k">GMV / 3bln</span></div></div>
        </div></div>
        <div class="fchip a"><div class="v tnum">312K</div><div class="k">Followers</div></div>
        <div class="fchip b"><div class="v up tnum">↑ 5,8%</div><div class="k">Eng. Rate</div></div>
        <div class="fchip c">
          <svg width="52" height="26" viewBox="0 0 52 26" fill="none"><polyline points="0,22 12,16 22,18 32,9 42,11 52,3" stroke="var(--good)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          <div><div class="v up tnum">3,1×</div><div class="k">ROI</div></div>
        </div>
      </div>
    </div>
    <div class="mkt-cta rv"><button class="btn solid"><span>Jelajahi Katalog →</span></button></div>
  </div>
</section>

<!-- SUCCESS -->
<section id="success" class="paper">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">Featured Success</span><h2 class="disp">Bukti, bukan janji.</h2></div>
      <p class="r">Geser untuk lihat transformasi kreator, brand, dan campaign kami. →</p>
    </div>
  </div>
  <div class="wrap">
    <div class="feat-scroll rv">
      <div class="fcard" data-h><div class="fthumb"><div class="img" data-bg="succ1"></div><span class="cat">Talent · Fashion</span><span class="k flame">Rp 600Jt</span></div><div class="fmeta"><span class="mn">@kesyamartgorsir</span><span class="up">/ satu sesi live</span></div></div>
      <div class="fcard" data-h><div class="fthumb"><div class="img" data-bg="blog1"></div><span class="cat">Talent · F&amp;B</span><span class="k flame">Award Tokopedia</span></div><div class="fmeta"><span class="mn">@siswanto146088</span><span class="up">Festival Beli Lokal '24</span></div></div>
      <div class="fcard" data-h><div class="fthumb"><div class="img" data-bg="blog3"></div><span class="cat">Talent · F&amp;B</span><span class="k flame">Rp 269Jt</span></div><div class="fmeta"><span class="mn">@jajankhasindo99</span><span class="up">GMV tercapai</span></div></div>
      <div class="fcard" data-h><div class="fthumb"><div class="img" data-bg="succ4"></div><span class="cat">Talent · Fashion</span><span class="k flame">Rp 101Jt</span></div><div class="fmeta"><span class="mn">@bakulankoe88</span><span class="up">GMV tumbuh konsisten</span></div></div>
    </div>
    <div style="text-align:center;margin-top:38px"><button class="btn rv" data-h><span>Lihat Semua Success Story →</span></button></div>
  </div>
</section>

<!-- TESTIMONIAL -->
<section id="testi">
  <div class="wrap">
    <div class="quote rv">
      <div class="ph" data-bg="test"></div>
      <div>
        <p class="serif">"Karena dukungan Tim VOBI, aku bisa dapat sampai <span class="flame">600 juta</span> dalam satu sesi live. VOBI bener-bener rumah yang ngebimbing."</p>
        <div class="who"><b>Kesya</b> &mdash; Talent Fashion, VOBI MCN</div>
      </div>
    </div>
  </div>
</section>

<!-- BLOG -->
<section id="blog">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">Latest Blog</span><h2 class="disp">Ilmu dari lapangan.</h2></div>
      <p class="r">Tips kreator, insight marketplace, dan tren digital terbaru.</p>
    </div>
    <div class="blog st">
      <a class="bcard" data-h><div class="bthumb"><div class="img" data-bg="blog1"></div></div><div class="bbody"><span class="cat">Creator Tips</span><h3>3 Tanda Kamu Siap Jadi Affiliate</h3><span class="rd">4 menit baca · 2026</span></div></a>
      <a class="bcard" data-h><div class="bthumb"><div class="img" data-bg="blog2"></div></div><div class="bbody"><span class="cat">Marketplace</span><h3>Kenapa Live Selling Menang di 2026</h3><span class="rd">6 menit baca · 2026</span></div></a>
      <a class="bcard" data-h><div class="bthumb"><div class="img" data-bg="blog3"></div></div><div class="bbody"><span class="cat">AI · Digital</span><h3>Bikin Konten 3× Lebih Cepat Pakai AI</h3><span class="rd">5 menit baca · 2026</span></div></a>
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="paper" id="faq">
  <div class="wrap">
    <div class="sec-head rv" style="justify-content:center;text-align:center"><div><span class="eyebrow" style="justify-content:center">FAQ</span><h2 class="disp">Sering ditanya.</h2></div></div>
    <div class="faq rv">
      <div class="fitem"><button class="fq" data-h>Gimana cara brand mulai kerjasama?<span class="pm"></span></button><div class="fa"><p>Pilih kreator di Campaign Marketplace, klik "Ajak Kerjasama", isi form singkat — tim kami langsung menghubungi kamu.</p></div></div>
      <div class="fitem"><button class="fq" data-h>Saya kreator baru, boleh gabung?<span class="pm"></span></button><div class="fa"><p>Sangat boleh. VOBI MCN memang rumah untuk kreator dari nol — non-seleb, real affiliate, semua kami bimbing.</p></div></div>
      <div class="fitem"><button class="fq" data-h>Platform apa saja yang didukung?<span class="pm"></span></button><div class="fa"><p>TikTok, Shopee, Lazada, dan YouTube — lewat unit VOBI, Victory Media, dan Upmedia.</p></div></div>
      <div class="fitem"><button class="fq" data-h>VOBI beroperasi di kota mana?<span class="pm"></span></button><div class="fa"><p>Palembang, Jakarta, Bandung, Jogja, Bali, Lampung, dan Jambi — dan terus berkembang.</p></div></div>
    </div>
  </div>
</section>

<!-- FINAL -->
<section class="final">
  <div class="glow"></div>
  <div class="wrap">
    <span class="eyebrow rv" style="justify-content:center">Mari Mulai</span>
    <h2 class="disp rv">Mari tumbuh<br><span class="flame">bersama</span> kami.</h2>
    <p class="rv">Brand mencari kreator? Kreator mencari rumah? Pintunya di sini.</p>
    <div class="hero-cta rv"><button class="btn solid" data-h><span>Konsultasi Gratis</span></button><button class="btn ghost" data-h><span>Chat WhatsApp</span></button></div>
  </div>
</section>
@endverbatim
@endsection
