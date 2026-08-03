@extends('layouts.app')

@section('title', 'Campaign & Paket — VOBI MCN & SEAMEDIA | VOBI Group')
@section('meta_description', 'Paket campaign VOBI Group dengan harga transparan: Viral Content (Rp 2jt), Story Driven (Rp 3jt), Live Support (Rp 200rb), Product Footage (Rp 150rb), dan Conversion Web (mulai Rp 1,25jt). Pilih & ajukan.')
@section('og_title', 'Campaign & Paket VOBI — Harga Transparan')

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
    <span class="eyebrow">Paket Campaign</span>
    <h1 class="disp">Paket <span class="flame">siap jalan</span>.</h1>
    <p class="lead2">Pilih paket dari VOBI MCN &amp; SEAMEDIA — harga transparan, isi paket jelas. Klik untuk lihat detail lengkapnya.</p>
  </div>
</section>

<section style="padding-top:44px">
  <div class="wrap">
    <div class="cmp2-grid st">
      @foreach ($campaigns as $cm)
        <article class="cmp2">
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
              <div class="pr"><small>Mulai dari</small><b class="tnum">{{ $cm->price_short }}</b></div>
              <a class="btn solid mini" href="{{ route('campaign.show', $cm) }}"><span>Detail &rarr;</span></a>
            </div>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>

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
