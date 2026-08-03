@extends('layouts.app')

@section('title', 'Tentang VOBI Group — Filosofi HOME, VOBI MCN & SEAMEDIA')
@section('meta_description', 'VOBI adalah HOME dalam bentuk digital agency. Kenali filosofi HOME (kejujuran, kepercayaan, kebersamaan), VOBI Listening Strategy, VOBI Family, dan ekosistem VOBI MCN + SEAMEDIA yang berbasis di Palembang.')
@section('og_title', 'Semesta VOBI — A Home Change Everything')

@push('head')
<script type="application/ld+json">@php
    echo json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Ekosistem', 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp</script>
@endpush

@php
    // Ikon medali (SVG) tetap per urutan; teks stop editable dari admin.
    $medals = [
        '<path d="M40 100 L100 48 L160 100"/><path d="M55 90 V152 H145 V90"/><path d="M86 152 V116 H114 V152"/>',
        '<rect x="80" y="38" width="40" height="72" rx="20"/><path d="M58 96 a42 42 0 0 0 84 0"/><line x1="100" y1="138" x2="100" y2="162"/><line x1="78" y1="162" x2="122" y2="162"/>',
        '<path d="M92 70 H62 a30 30 0 0 0 0 60 h30"/><path d="M108 70 h30 a30 30 0 0 1 0 60 h-30"/><line x1="74" y1="100" x2="126" y2="100"/>',
        '<circle cx="100" cy="64" r="22"/><path d="M62 150 a38 38 0 0 1 76 0"/><circle cx="48" cy="86" r="15"/><path d="M22 148 a28 28 0 0 1 28 -22"/><circle cx="152" cy="86" r="15"/><path d="M178 148 a28 28 0 0 0 -28 -22"/>',
        '<rect x="34" y="48" width="132" height="92" rx="10"/><line x1="34" y1="72" x2="166" y2="72"/><circle cx="48" cy="60" r="3"/><line x1="80" y1="162" x2="120" y2="162"/><line x1="100" y1="140" x2="100" y2="162"/>',
    ];
    $ekoStops = setting_arr('eko_stops', [
        ['city' => 'Filosofi', 'lh' => 'Makna *HOME*.', 'ld' => 'Tempat kita berangkat dan kembali — tempat diterima, didengar, dan tumbuh bersama.'],
        ['city' => 'VOBI MCN', 'lh' => 'Rumah *talent*.', 'ld' => '600+ talent dibina dari micro sampai mega-scale — jadi kreator yang profesional & menghibur.'],
        ['city' => 'TAP System', 'lh' => 'Menjodohkan *seller* & kreator.', 'ld' => 'TikTok Affiliate Partner: matchmaking + product campaign, 6 kategori. Komisi di atas rata-rata.'],
        ['city' => 'VOBI Family', 'lh' => 'Rasa *memiliki*.', 'ld' => 'Sense of belonging & komunikasi jadi fondasi partnership yang sukses — ekosistem yang nyaman.'],
        ['city' => 'SEAMEDIA', 'lh' => 'Dari konten ke *konversi*.', 'ld' => 'Professional partner untuk digital journey: produksi konten, live, sampai website konversi untuk UMKM.'],
    ]);
    $ekoStats = setting_arr('eko_finale_stats', [
        ['value' => '600', 'suffix' => '+', 'label' => 'Talent'],
        ['value' => '4.000', 'suffix' => '+', 'label' => 'Creator'],
        ['value' => '800', 'suffix' => '+', 'label' => 'Brand/Seller'],
        ['value' => '2.000', 'suffix' => '+', 'label' => 'Collaboration'],
    ]);
    $ekoUnits = setting_arr('eko_units', [
        ['uf' => 'Talent & MCN', 'un' => 'VOBI MCN', 'url' => route('gabung')],
        ['uf' => 'TikTok Affiliate', 'un' => 'TAP System', 'url' => route('layanan')],
        ['uf' => 'Content Creation', 'un' => 'SEAMEDIA', 'url' => route('layanan')],
        ['uf' => 'Website', 'un' => 'Conversion Web', 'url' => route('creator')],
    ]);
    $ekoValues = setting_arr('eko_values', ['Honesty', 'Trust', 'Togetherness', 'Growth', 'Convenience']);
@endphp

@section('body')

<section class="jrny">
  <nav class="wrap crumb" aria-label="Breadcrumb" style="justify-content:center;color:#8a7f73;margin:64px 0 28px">
    <a href="{{ route('home') }}" style="color:#8a7f73">Beranda</a><span class="sep">/</span><span>Ekosistem</span>
  </nav>

  <div class="intro" style="text-align:center;max-width:820px;margin:0 auto;padding:0 24px">
    <span class="welcome">{{ setting('eko_welcome', 'A Home Change Everything') }}</span>
    <h2 class="big">{!! flame_text(setting('eko_title', 'VOBI adalah<br>*rumah.*')) !!}</h2>
    <p class="sub">{{ setting('eko_sub', 'Di rumah, kami menemukan kejujuran, kepercayaan, kebersamaan, dan niat untuk saling membangun. Scroll pelan — ikuti perjalanannya.') }}</p>
  </div>

  <div class="route3" id="route3">
    <div class="rail"><span class="fill"></span></div>
    <div class="jmarker" aria-hidden="true"></div>

    <div class="stops">
      @foreach ($ekoStops as $i => $stop)
        <article class="stop">
          <div class="node"></div>
          <div class="medal">
            <svg viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" role="img" aria-label="{{ $stop['city'] ?? '' }}">
              {!! $medals[$i] ?? $medals[0] !!}
            </svg>
          </div>
          <div class="info"><span class="idx">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span><div class="city">{{ $stop['city'] ?? '' }}</div><div class="lh">{!! flame_text($stop['lh'] ?? '') !!}</div><p class="ld">{{ $stop['ld'] ?? '' }}</p></div>
        </article>
      @endforeach
    </div>

    {{-- Finale --}}
    <div class="jfin" id="jfin">
      <div class="city" style="text-align:center;color:#8a7f73;font-family:var(--serif);font-size:.74rem;letter-spacing:.22em;text-transform:uppercase">{{ setting('eko_finale_kicker', 'Berbasis di Palembang · Official Partner') }}</div>
      <div class="lh" style="margin-top:10px">{!! flame_text(setting('eko_finale_line', '…dan terus *bertumbuh.*')) !!}</div>
      <div class="jfin-nums">
        @foreach ($ekoStats as $stat)
          <div><div class="v"><em>{{ $stat['value'] ?? '' }}</em>{{ $stat['suffix'] ?? '' }}</div><div class="k">{{ $stat['label'] ?? '' }}</div></div>
        @endforeach
      </div>
    </div>
  </div>
</section>

{{-- Units (minimal, cream) --}}
<section class="journey" style="padding-top:0;padding-bottom:90px">
  <div class="wrap">
    <span class="eyebrow">Ekosistem</span>
    <div class="units-line">
      @foreach ($ekoUnits as $u)
        <a class="unit-cell" href="{{ $u['url'] ?? route('layanan') }}"><div class="uf">{{ $u['uf'] ?? '' }}</div><div class="un">{{ $u['un'] ?? '' }}</div></a>
      @endforeach
    </div>
  </div>
</section>

{{-- Values marquee (dark) — VOBI SPIRIT --}}
<section style="padding:76px 0">
  <div class="wrap" style="margin-bottom:14px"><span class="eyebrow" style="justify-content:center;width:100%">VOBI Spirit</span></div>
  <div class="vmarq"><div class="vtrack" id="vtrack">
    @foreach ($ekoValues as $i => $val)
      <span class="vw {{ $i % 2 === 0 ? 'fill' : '' }}">{{ $val }}</span><span class="vstar"></span>
    @endforeach
  </div></div>
</section>

{{-- Listening Strategy note --}}
<section style="padding:20px 0 90px">
  <div class="wrap" style="max-width:820px;margin:0 auto;text-align:center">
    <span class="eyebrow rv" style="justify-content:center">VOBI Listening Strategy</span>
    <p class="rv" style="font-family:var(--serif);font-size:clamp(1.3rem,3vw,1.9rem);line-height:1.5;color:var(--ink);margin-top:20px;text-wrap:balance">
      {!! flame_text(setting('eko_listening_quote', '“Kami *mendengar* lebih dulu — menangkap input yang relevan, merespons pasar lebih efisien, dan membangun koneksi baik dengan kreator & klien.”')) !!}
    </p>
  </div>
</section>

{{-- CTA --}}
<section class="final">
  <div class="glow"></div>
  <div class="wrap">
    <span class="eyebrow rv" style="justify-content:center">{{ setting('eko_final_eyebrow', 'Mari Mulai') }}</span>
    <h2 class="disp rv">{!! flame_text(setting('eko_final_title', 'Mau jadi bagian<br>*keluarganya?*')) !!}</h2>
    <p class="rv">{{ setting('eko_final_text', 'Talent mencari rumah? Brand mencari kreator? Pintunya di sini.') }}</p>
    <div class="hero-cta rv" style="justify-content:center">
      <a class="btn solid" href="{{ route('gabung') }}"><span>Cara Gabung &rarr;</span></a>
      <a class="btn ghost" href="{{ route('kontak') }}"><span>Konsultasi Gratis</span></a>
    </div>
  </div>
</section>

@push('scripts')
<script>
(function(){
  var route = document.getElementById('route3');
  if(!route) return;
  var fill = route.querySelector('.rail .fill');
  var mk = route.querySelector('.jmarker');
  var fin = document.getElementById('jfin');
  var vt = document.getElementById('vtrack'); if(vt) vt.innerHTML += vt.innerHTML;
  var rm = matchMedia('(prefers-reduced-motion:reduce)').matches;

  var io = new IntersectionObserver(function(es){
    es.forEach(function(e){ if(e.isIntersecting){ e.target.classList.add('in'); io.unobserve(e.target); } });
  }, { threshold: 0.3 });
  [].forEach.call(route.querySelectorAll('.stop'), function(s){ io.observe(s); });
  if(fin) io.observe(fin);

  var rail = route.querySelector('.rail');
  function update(){
    var r = rail.getBoundingClientRect(), vh = innerHeight;
    var p = ((vh*0.55) - r.top) / r.height;
    p = Math.max(0, Math.min(1, p));
    fill.style.height = (p*100) + '%';
    mk.style.top = (14 + p * r.height) + 'px';
    mk.style.opacity = p > 0.004 ? 1 : 0;
  }
  if(rm){ fill.style.height='100%'; mk.style.opacity=0;
    [].forEach.call(route.querySelectorAll('.stop'), function(s){ s.classList.add('in'); });
    if(fin) fin.classList.add('in'); return; }
  addEventListener('scroll', update, {passive:true});
  addEventListener('resize', update, {passive:true});
  addEventListener('load', update);
  update();
})();
</script>
@endpush

@endsection
