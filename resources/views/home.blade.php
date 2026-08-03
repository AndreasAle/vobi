@extends('layouts.app')

@section('title', setting('home_seo_title', 'VOBI — Talent Agency & Creator Economy untuk Brand & Kreator'))
@section('meta_description', setting('home_seo_description', 'VOBI Group: rumah bertumbuh untuk brand dan kreator. Layanan affiliate TikTok & Shopee, produksi konten, live streaming, video content, dan Campaign Marketplace. 12.000+ kreator aktif di 7 kota Indonesia.'))

@php
    // ===== Default konten (dipakai bila admin belum mengisi) =====
    $svcCards = setting_arr('home_service_cards', [
        ['title' => 'Creator Management', 'tag' => 'VOBI MCN', 'color' => '#3B2E6E', 'image' => 'eco1'],
        ['title' => 'Campaign Marketplace', 'tag' => 'VOBI', 'color' => '#B05A32', 'image' => 'eco2'],
        ['title' => 'Viral & Story Driven Content', 'tag' => 'SEAMEDIA', 'color' => '#1F5D52', 'image' => 'vobi-content'],
        ['title' => 'Conversion Web & SEO', 'tag' => 'SEAMEDIA', 'color' => '#2B4E86', 'image' => 'vobi-web'],
        ['title' => 'Live Streaming Service', 'tag' => 'VOBI MCN', 'color' => '#7A3560', 'image' => 'succ3'],
    ]);

    $brands = setting_arr('home_brands', [
        'Rinso', 'Unilever', "L'Oréal Paris", 'Listerine', 'Neutrogena', 'Blackmores', 'Y.O.U', 'Baseus', 'Madame Gie', 'Aveeno',
        'Anlene', 'Robot', 'Grandville', 'Mom Uung', 'Anmum', 'Mixio', 'Greney', 'Moell', 'TKIS', 'Revita',
    ]);
    $brandStyles = ['w-round', 'w-ital', 'w-caps', 'w-serif', 'w-light'];
    $brandHalf = (int) ceil(count($brands) / 2);
    $brandsA = array_slice($brands, 0, $brandHalf);
    $brandsB = array_slice($brands, $brandHalf);

    $pillars = setting_arr('home_eco_pillars', [
        ['tag' => 'TikTok Affiliate · MCN', 'name' => 'VOBI', 'desc' => 'Rumah bagi 600+ talent — dibina dari micro sampai mega-scale, dan diberi panggung.', 'image' => 'eco1', 'url' => route('ekosistem')],
        ['tag' => 'TikTok · Top Creator', 'name' => 'VICTORY MEDIA', 'desc' => 'Ekspansi kreator top & kerjasama eksklusif.', 'image' => 'eco2', 'url' => route('ekosistem')],
        ['tag' => 'Shopee Affiliate', 'name' => 'UPMEDIA', 'desc' => 'Inkubasi & keberlangsungan affiliate Shopee.', 'image' => 'eco3', 'url' => route('ekosistem')],
        ['tag' => 'Content & Conversion Web', 'name' => 'SEAMEDIA', 'desc' => 'Produksi konten, live streaming, & website konversi untuk UMKM.', 'image' => 'vobi-content', 'url' => route('layanan')],
    ]);
    $pillarLayout = [['h' => 540, 'o' => 0], ['h' => 430, 'o' => 66], ['h' => 400, 'o' => 26], ['h' => 468, 'o' => 100]];

    $svcRows = setting_arr('home_services_rows', [
        ['title' => 'Creator Economy', 'tags' => 'MCN · Affiliate · Campaign'],
        ['title' => 'Content Production', 'tags' => 'Photography · Videography · Livestream'],
        ['title' => 'Digital', 'tags' => 'Website · Landing Page · SEO · Maintenance'],
        ['title' => 'Social Media', 'tags' => 'Management · Strategy · Monthly Content · Ads'],
    ]);

    $faqs = setting_arr('home_faq', [
        ['q' => 'Gimana cara brand mulai kerjasama?', 'a' => 'Pilih kreator di Campaign Marketplace, klik "Ajak Kerjasama", isi form singkat — tim kami langsung menghubungi kamu.'],
        ['q' => 'Saya kreator baru, boleh gabung?', 'a' => 'Sangat boleh. VOBI MCN memang rumah untuk kreator dari nol — non-seleb, real affiliate, semua kami bimbing.'],
        ['q' => 'Platform apa saja yang didukung?', 'a' => 'TikTok, Shopee, Lazada, dan YouTube — lewat unit VOBI, Victory Media, dan Upmedia.'],
        ['q' => 'VOBI beroperasi di kota mana?', 'a' => 'Palembang, Jakarta, Bandung, Jogja, Bali, Lampung, dan Jambi — dan terus berkembang.'],
    ]);
@endphp

@section('body')
<!-- HERO — full-bleed background video -->
<section class="hero" id="top">
  <video class="hero-vid" data-vid="hero" autoplay muted loop playsinline preload="auto"></video>
  <div class="wrap">
    <div class="hero-copy">
      <div class="hero-eyebrow">{!! flame_text(setting('home_hero_eyebrow', 'Creator Economy / Digital Growth')) !!}</div>
      <h1 class="disp">
        <span class="l"><span>{{ setting('home_hero_l1', 'A Home') }}</span></span>
        <span class="l"><span class="flame">{{ setting('home_hero_l2', 'Changes') }}</span></span>
        <span class="l"><span>{{ setting('home_hero_l3', 'Everything.') }}</span></span>
      </h1>
      <div class="sub-row">
        <span class="sub-bar"></span>
        <p class="sub">{{ setting('home_hero_sub', 'Every great journey begins with a place to belong. Kami menciptakan rumah — tempat yang nyaman untuk sebuah ide lahir, kolaborasi tumbuh, dan bisnis berkembang.') }}</p>
      </div>
    </div>
    <div class="hero-shelf">
      <div class="shelf-head"><span class="sh-label">Layanan Kami</span><span class="sh-line"></span><span class="sh-hint">geser untuk lihat &rarr;</span></div>
      <div class="svc-strip" id="svcstrip">
        @foreach ($svcCards as $card)
          <div class="svc-card" style="--c:{{ $card['color'] ?? '#3B2E6E' }}"><div class="pic" style="background-image:url('{{ media_url($card['image'] ?? null, 'eco1') }}')"></div><span class="arrow">&#8599;</span><div class="t">{{ $card['title'] ?? '' }}</div><div class="tag2">{{ $card['tag'] ?? '' }}</div></div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- BRAND WALL -->
<section class="brands" id="brands">
  <div class="wrap bhead rv">
    <span class="eyebrow" style="justify-content:center">{{ setting('home_brands_eyebrow', 'Dipercaya Oleh') }}</span>
    <h2>{{ setting('home_brands_title', 'Brand ternama yang tumbuh bersama kami.') }}</h2>
  </div>
  <div class="brow">
    <div class="btrack l">
      @foreach ($brandsA as $i => $b)
        <div class="blogo"><b class="{{ $brandStyles[$i % count($brandStyles)] }}">{{ $b }}</b></div>
      @endforeach
    </div>
  </div>
  <div class="brow" style="margin-top:16px">
    <div class="btrack r">
      @foreach ($brandsB as $i => $b)
        <div class="blogo"><b class="{{ $brandStyles[$i % count($brandStyles)] }}">{{ $b }}</b></div>
      @endforeach
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
      <div><span class="eyebrow">{{ setting('home_perf_eyebrow', 'Performance Overview') }}</span><h2 class="disp">{{ setting('home_perf_title', 'Angka yang bicara.') }}</h2></div>
      <p class="r">{{ setting('home_perf_sub', 'Rekap gabungan ekosistem VOBI Group — VOBI MCN & SEAMEDIA.') }}</p>
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
      <div><span class="eyebrow">{{ setting('home_eco_eyebrow', 'Everything You Need · Under One Roof') }}</span><h2 class="disp">{!! flame_text(setting('home_eco_title', 'Empat pilar,<br>satu rumah.')) !!}</h2></div>
      <p class="r">{{ setting('home_eco_sub', 'Satu tujuan: membantu bisnis bertumbuh lebih cepat.') }}</p>
    </div>
    <div class="eco2" id="eco2">
      @foreach ($pillars as $i => $p)
        @php $lay = $pillarLayout[$i] ?? ['h' => 430, 'o' => 40]; @endphp
        <div class="epar {{ $i === 0 ? 'feat' : '' }}" style="--h:{{ $lay['h'] }}px;--o:{{ $lay['o'] }}px">
          <a class="ecard {{ $i === 0 ? 'big' : '' }}" href="{{ $p['url'] ?? route('ekosistem') }}"><div class="eimg" style="background-image:url('{{ media_url($p['image'] ?? null, 'eco1') }}')"></div><span class="enum">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span><span class="ego">↗</span>
            <div class="ebody"><span class="etag">{{ $p['tag'] ?? '' }}</span><div class="en">{{ $p['name'] ?? '' }}</div>
              <p class="edesc">{{ $p['desc'] ?? '' }}</p></div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- SERVICES -->
<section id="services">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">{{ setting('home_services_eyebrow', 'What We Do') }}</span><h2 class="disp">{{ setting('home_services_title', 'Layanan penuh, ujung ke ujung.') }}</h2></div>
      <p class="r">{{ setting('home_services_sub', 'Dari creator economy sampai produk digital — semua di bawah satu atap.') }}</p>
    </div>
    <div class="srv st">
      @foreach ($svcRows as $i => $row)
        <div class="srv-row" data-h><span class="idx">({{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }})</span><h3>{{ $row['title'] ?? '' }}</h3><span class="tags">{{ $row['tags'] ?? '' }}</span><span class="arr">↗</span></div>
      @endforeach
    </div>
  </div>
</section>

<!-- MARKETPLACE -->
<section id="mkt">
  <div class="wrap">
    <div class="mkt-head rv"><h2>{!! flame_text(setting('home_mkt_title', 'Campaign *Marketplace*')) !!}</h2></div>
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
    <div class="mkt-cta rv"><a class="btn solid" href="{{ route('creator') }}"><span>Jelajahi Katalog →</span></a></div>
  </div>
</section>

<!-- SUCCESS -->
<section id="success" class="paper">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">{{ setting('home_success_eyebrow', 'Featured Success') }}</span><h2 class="disp">{{ setting('home_success_title', 'Bukti, bukan janji.') }}</h2></div>
      <p class="r">{{ setting('home_success_sub', 'Geser untuk lihat transformasi kreator, brand, dan campaign kami. →') }}</p>
    </div>
  </div>
  <div class="wrap">
    <div class="feat-scroll rv">
      <div class="fcard" data-h><div class="fthumb"><div class="img" data-bg="succ1"></div><span class="cat">Talent · Fashion</span><span class="k flame">Rp 600Jt</span></div><div class="fmeta"><span class="mn">&#64;kesyamartgorsir</span><span class="up">/ satu sesi live</span></div></div>
      <div class="fcard" data-h><div class="fthumb"><div class="img" data-bg="blog1"></div><span class="cat">Talent · F&amp;B</span><span class="k flame">Award Tokopedia</span></div><div class="fmeta"><span class="mn">&#64;siswanto146088</span><span class="up">Festival Beli Lokal '24</span></div></div>
      <div class="fcard" data-h><div class="fthumb"><div class="img" data-bg="blog3"></div><span class="cat">Talent · F&amp;B</span><span class="k flame">Rp 269Jt</span></div><div class="fmeta"><span class="mn">&#64;jajankhasindo99</span><span class="up">GMV tercapai</span></div></div>
      <div class="fcard" data-h><div class="fthumb"><div class="img" data-bg="succ4"></div><span class="cat">Talent · Fashion</span><span class="k flame">Rp 101Jt</span></div><div class="fmeta"><span class="mn">&#64;bakulankoe88</span><span class="up">GMV tumbuh konsisten</span></div></div>
    </div>
    <div style="text-align:center;margin-top:38px"><a class="btn rv" data-h href="{{ route('creator') }}"><span>Lihat Semua Success Story →</span></a></div>
  </div>
</section>

<!-- TESTIMONIAL -->
<section id="testi">
  <div class="wrap">
    <div class="quote rv">
      <div class="ph" data-bg="test"></div>
      <div>
        <p class="serif">{!! flame_text(setting('home_testi_quote', '"Karena dukungan Tim VOBI, aku bisa dapat sampai *600 juta* dalam satu sesi live. VOBI bener-bener rumah yang ngebimbing."')) !!}</p>
        <div class="who">{!! flame_text(setting('home_testi_author', '*Kesya* — Talent Fashion, VOBI MCN')) !!}</div>
      </div>
    </div>
  </div>
</section>

<!-- BLOG -->
<section id="blog">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">{{ setting('home_blog_eyebrow', 'Latest Blog') }}</span><h2 class="disp">{{ setting('home_blog_title', 'Ilmu dari lapangan.') }}</h2></div>
      <p class="r">{{ setting('home_blog_sub', 'Tips kreator, insight marketplace, dan tren digital terbaru.') }}</p>
    </div>
    <div class="blog st">
      @php $latest = \App\Models\Post::where('is_published', true)->latest('published_at')->take(3)->get(); @endphp
      @if ($latest->count())
        @foreach ($latest as $p)
          <a class="bcard" data-h href="{{ route('blog.show', $p) }}"><div class="bthumb"><div class="img" style="background-image:url('{{ $p->image_url }}')"></div></div><div class="bbody"><span class="cat">{{ $p->category }}</span><h3>{{ $p->title }}</h3><span class="rd">{{ $p->read_min }} menit baca · {{ optional($p->published_at)->format('Y') }}</span></div></a>
        @endforeach
      @else
        <a class="bcard" data-h><div class="bthumb"><div class="img" data-bg="blog1"></div></div><div class="bbody"><span class="cat">Creator Tips</span><h3>3 Tanda Kamu Siap Jadi Affiliate</h3><span class="rd">4 menit baca · 2026</span></div></a>
        <a class="bcard" data-h><div class="bthumb"><div class="img" data-bg="blog2"></div></div><div class="bbody"><span class="cat">Marketplace</span><h3>Kenapa Live Selling Menang di 2026</h3><span class="rd">6 menit baca · 2026</span></div></a>
        <a class="bcard" data-h><div class="bthumb"><div class="img" data-bg="blog3"></div></div><div class="bbody"><span class="cat">AI · Digital</span><h3>Bikin Konten 3× Lebih Cepat Pakai AI</h3><span class="rd">5 menit baca · 2026</span></div></a>
      @endif
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="paper" id="faq">
  <div class="wrap">
    <div class="sec-head rv" style="justify-content:center;text-align:center"><div><span class="eyebrow" style="justify-content:center">FAQ</span><h2 class="disp">Sering ditanya.</h2></div></div>
    <div class="faq rv">
      @foreach ($faqs as $item)
        <div class="fitem"><button class="fq" data-h>{{ $item['q'] ?? '' }}<span class="pm"></span></button><div class="fa"><p>{{ $item['a'] ?? '' }}</p></div></div>
      @endforeach
    </div>
  </div>
</section>

<!-- FINAL -->
<section class="final">
  <div class="glow"></div>
  <div class="wrap">
    <span class="eyebrow rv" style="justify-content:center">{{ setting('home_final_eyebrow', 'Mari Mulai') }}</span>
    <h2 class="disp rv">{!! flame_text(setting('home_final_title', 'Mari tumbuh<br>*bersama* kami.')) !!}</h2>
    <p class="rv">{{ setting('home_final_text', 'Brand mencari kreator? Kreator mencari rumah? Pintunya di sini.') }}</p>
    <div class="hero-cta rv"><a class="btn solid" href="{{ route('kontak') }}"><span>Konsultasi Gratis</span></a><a class="btn ghost" href="https://wa.me/{{ setting('contact_wa_vobi', '6289519406185') }}"><span>Chat WhatsApp</span></a></div>
  </div>
</section>
@endsection
