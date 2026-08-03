@extends('layouts.app')

@section('title', 'Blog VOBI — Tips Talent, TAP System, Conversion Web & Konten')
@section('meta_description', 'Blog VOBI Group: cara kerja TAP System, kenapa UMKM butuh website (Conversion Web), kisah sukses talent VOBI, dan panduan memilih paket konten SEAMEDIA.')
@section('og_title', 'Blog VOBI — Ilmu dari Lapangan')

@push('head')
<script type="application/ld+json">@php
    echo json_encode([
        '@context' => 'https://schema.org', '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp</script>
@endpush

@php
    $lead = $posts->first();
    $side = $posts->slice(1)->take(3);
@endphp

@section('body')

<header class="blog-head">
  <div class="wrap">
    <nav class="crumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Beranda</a><span class="sep">/</span><span>Blog</span></nav>
    <span class="eyebrow">Latest Blog</span>
    <h1 class="disp" style="font-size:clamp(2.4rem,6vw,4rem);margin:12px 0 0">Ilmu dari lapangan.</h1>

    @if ($lead)
    <div class="trend-bar">
      <span class="tlabel">Trending</span>
      <a href="{{ route('blog.show', $lead) }}">{{ $lead->title }}</a>
    </div>
    @endif
  </div>
</header>

{{-- ===== Featured mosaic ===== --}}
<section style="padding-top:0">
  <div class="wrap">
    <div class="mag-feat">
      @if ($lead)
      <a class="mtile mlead rv" href="{{ route('blog.show', $lead) }}">
        <div class="img" style="background-image:url('{{ $lead->image_url }}')"></div>
        <span class="cat">{{ $lead->category }}</span>
        <h2>{{ $lead->title }}</h2>
        <div class="meta">VOBI &middot; {{ $lead->read_min }} menit baca &middot; {{ optional($lead->published_at)->translatedFormat('d M Y') }}</div>
      </a>
      @endif
      <div class="mside">
        @foreach ($side as $p)
        <a class="mtile msmall rv" href="{{ route('blog.show', $p) }}">
          <div class="img" style="background-image:url('{{ $p->image_url }}')"></div>
          <span class="cat">{{ $p->category }}</span>
          <h3>{{ $p->title }}</h3>
          <div class="meta">{{ $p->read_min }} menit baca</div>
        </a>
        @endforeach
      </div>
    </div>
  </div>
</section>

{{-- ===== List + sidebar ===== --}}
<section style="padding-top:0">
  <div class="wrap mag-body">
    <div class="mag-list">
      <div class="sec-head rv" style="margin-bottom:24px"><div><span class="eyebrow">Semua Artikel</span></div></div>
      @foreach ($posts as $p)
        <a class="mrow rv" href="{{ route('blog.show', $p) }}">
          <div class="mthumb"><div class="img" style="background-image:url('{{ $p->image_url }}')"></div></div>
          <div>
            <span class="cat">{{ $p->category }}</span>
            <h3>{{ $p->title }}</h3>
            <div class="meta">{{ $p->read_min }} menit baca &middot; {{ optional($p->published_at)->translatedFormat('d M Y') }}</div>
          </div>
        </a>
      @endforeach
    </div>

    <aside class="mag-aside">
      <div class="awidget rv">
        <div class="ah">Topik</div>
        <div class="topics">
          @foreach ($categories as $c)
            <a href="{{ route('blog') }}">{{ $c }}</a>
          @endforeach
        </div>
      </div>

      <div class="awidget rv">
        <div class="ah">Ikuti Kami</div>
        <div class="socialrow">
          <a href="https://www.instagram.com/vobi.id/" target="_blank" rel="noopener">Instagram</a>
          <a href="#" target="_blank" rel="noopener">TikTok</a>
          <a href="#" target="_blank" rel="noopener">YouTube</a>
        </div>
      </div>

      <div class="awidget cta rv">
        <h4>Jadi talent VOBI.</h4>
        <p>Belajar sambil bertumbuh bareng tim yang menjalankannya langsung.</p>
        <a class="btn solid" href="{{ route('gabung') }}"><span>Cara Gabung &rarr;</span></a>
      </div>
    </aside>
  </div>
</section>

{{-- CTA --}}
<section class="final">
  <div class="glow"></div>
  <div class="wrap">
    <span class="eyebrow rv" style="justify-content:center">Terus Berkembang</span>
    <h2 class="disp rv">Mau ilmunya <span class="flame">langsung</span> dari ahlinya?</h2>
    <div class="hero-cta rv" style="justify-content:center">
      <a class="btn solid" href="{{ route('kontak') }}"><span>Konsultasi Gratis</span></a>
      <a class="btn ghost" href="{{ route('campaign') }}"><span>Lihat Paket</span></a>
    </div>
  </div>
</section>

@endsection
