@extends('layouts.app')

@section('title', 'Campaign & Paket — VOBI MCN & SEAMEDIA | VOBI Group')
@section('meta_description', 'Campaign marketplace VOBI Group — pilih paket campaign dari VOBI MCN, SEAMEDIA, dan unit lainnya. Filter per unit, lihat campaign sorotan, dan ajukan langsung.')
@section('og_title', 'Campaign Marketplace VOBI Group')

@push('head')
<script type="application/ld+json">@php
    echo json_encode([
        '@context' => 'https://schema.org', '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Campaign', 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp</script>
@endpush

@section('body')

<section class="mk-hero">
  <div class="wrap">
    <nav class="crumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Beranda</a><span class="sep">/</span><span>Campaign</span></nav>
    <span class="eyebrow">Campaign Marketplace</span>
    <h1 class="disp">Campaign <span class="flame">siap jalan</span>.</h1>
    <p class="lead2">Pilih campaign dari tiap unit VOBI — VOBI MCN, SEAMEDIA, dan lainnya. Saring per unit, atau mulai dari campaign sorotan di bawah.</p>
  </div>
</section>

{{-- ===== Campaign Sorotan (Top) ===== --}}
@if ($featured)
<section class="cmp-feat-wrap">
  <div class="wrap">
    <div class="cmp-feat-label rv"><span class="star">&#9733;</span> Campaign Sorotan</div>
    <article class="cmp-feat rv">
      <a class="cmp-feat-media" href="{{ route('campaign.show', $featured) }}" aria-label="Detail {{ $featured->title }}">
        <div class="img" style="background-image:url('{{ $featured->image_url }}')"></div>
        <span class="cmp-feat-cat">{{ $featured->category }}</span>
      </a>
      <div class="cmp-feat-body">
        <div class="cmp-feat-unit">{{ $featured->creator_name }} &middot; {{ $featured->service }}</div>
        <h2>{{ $featured->title }}</h2>
        <p>{{ $featured->subtitle }}</p>
        <div class="cmp-feat-meta">
          @if ($featured->performance)<span class="pill-good">{{ $featured->performance }}</span>@endif
          @if ($featured->days_left !== null)<span class="pill-soft">@if($featured->days_left <= 0) Berakhir hari ini @else Berakhir dalam {{ $featured->days_left }} hari @endif</span>@endif
        </div>
        <div class="cmp-feat-cta">
          <a class="btn solid" href="{{ route('campaign.show', $featured) }}"><span>Lihat Detail &rarr;</span></a>
        </div>
      </div>
    </article>
  </div>
</section>
@endif

{{-- ===== Filter per Unit + Grid ===== --}}
<section style="padding-top:36px">
  <div class="wrap">
    <div class="cmp-bar rv">
      <div class="cmp-tabs" id="cmpTabs">
        <button class="cmp-tab on" data-unit="all">Semua <span>{{ $campaigns->count() }}</span></button>
        @foreach ($units as $u)
          @php $n = $campaigns->where('creator_name', $u)->count(); @endphp
          @if ($n)<button class="cmp-tab" data-unit="{{ $u }}">{{ $u }} <span>{{ $n }}</span></button>@endif
        @endforeach
      </div>
    </div>

    <div class="cmp2-grid st" id="cmpGrid">
      @foreach ($campaigns as $cm)
        <article class="cmp2 js-cmp" data-unit="{{ $cm->creator_name }}">
          <a class="cmp2-media" href="{{ route('campaign.show', $cm) }}" aria-label="Detail {{ $cm->title }}">
            <span class="cmp2-cat">{{ $cm->category }}</span>
            @if ($cm->days_left !== null)
              <span class="cmp2-time @if($cm->days_left <= 5) soon @endif">
                @if($cm->days_left <= 0) Berakhir hari ini @else Sisa {{ $cm->days_left }} hari @endif
              </span>
            @endif
            <div class="img" style="background-image:url('{{ $cm->image_url }}')"></div>
            <span class="cmp2-pf">{{ $cm->performance }}</span>
          </a>
          <div class="cmp2-body">
            <div class="cmp2-u">{{ $cm->creator_name }} &middot; {{ $cm->service }}</div>
            <h3><a href="{{ route('campaign.show', $cm) }}" style="color:inherit">{{ $cm->title }}</a></h3>
            <div class="cmp2-foot">
              <a class="btn solid mini" href="{{ route('campaign.show', $cm) }}"><span>Lihat Detail &rarr;</span></a>
            </div>
          </div>
        </article>
      @endforeach
    </div>
    <div class="cmp-empty" id="cmpEmpty" style="display:none">Belum ada campaign untuk unit ini.</div>
  </div>
</section>

@push('scripts')
<script>
(function(){
  var tabs=document.querySelectorAll('.cmp-tab'),cards=document.querySelectorAll('.js-cmp'),empty=document.getElementById('cmpEmpty');
  tabs.forEach(function(t){t.addEventListener('click',function(){
    tabs.forEach(function(x){x.classList.remove('on');});t.classList.add('on');
    var u=t.dataset.unit,shown=0;
    cards.forEach(function(c){var m=(u==='all'||c.dataset.unit===u);c.style.display=m?'':'none';if(m)shown++;});
    if(empty)empty.style.display=shown?'none':'';
  });});
})();
</script>
@endpush

{{-- How it works --}}
<section class="paper">
  <div class="wrap">
    <div class="sec-head rv" style="justify-content:center;text-align:center">
      <div><span class="eyebrow" style="justify-content:center">Cara Kerja</span><h2 class="disp">Tiga langkah, satu klik.</h2></div>
    </div>
    <div class="values st">
      <div class="value"><div class="vn">01</div><div class="vh">Pilih Paket</div><div class="vp">Lihat detail &amp; harga tiap paket.</div></div>
      <div class="value"><div class="vn">02</div><div class="vh">Ajukan</div><div class="vp">Via WhatsApp atau form singkat.</div></div>
      <div class="value"><div class="vn">03</div><div class="vh">Jalan</div><div class="vp">Tim kami eksekusi sampai selesai.</div></div>
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="final">
  <div class="glow"></div>
  <div class="wrap">
    <span class="eyebrow rv" style="justify-content:center">Bingung Pilih?</span>
    <h2 class="disp rv">Konsultasi <span class="flame">gratis</span> dulu.</h2>
    <p class="rv">Ceritakan kebutuhanmu — tim kami bantu petakan paket yang paling pas.</p>
    <div class="hero-cta rv" style="justify-content:center">
      <a class="btn solid" href="{{ route('kontak') }}"><span>Konsultasi Gratis</span></a>
      <a class="btn ghost" href="{{ route('creator') }}"><span>Lihat Creator</span></a>
    </div>
  </div>
</section>

@endsection
