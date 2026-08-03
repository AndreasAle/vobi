@extends('layouts.app')

@section('title', $post->title . ' — Blog VOBI')
@section('meta_description', $post->excerpt)
@section('og_title', $post->title)
@section('og_description', $post->excerpt)

@push('head')
<meta property="og:type" content="article">
<meta property="og:image" content="{{ $post->image_url }}">
<script type="application/ld+json">@php
    echo json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $post->title,
        'description' => $post->excerpt,
        'image' => $post->image_url,
        'datePublished' => optional($post->published_at)->toIso8601String(),
        'author' => ['@type' => 'Organization', 'name' => 'VOBI Group'],
        'publisher' => ['@type' => 'Organization', 'name' => 'VOBI Group'],
        'mainEntityOfPage' => url()->current(),
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp</script>
<script type="application/ld+json">@php
    echo json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => route('blog')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $post->title, 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp</script>
@endpush

@section('body')

<article>
  <header class="article-hero">
    <div class="wrap" style="max-width:760px">
      <nav class="crumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Beranda</a><span class="sep">/</span><a href="{{ route('blog') }}">Blog</a><span class="sep">/</span><span>{{ $post->category }}</span></nav>
      <div class="cat">{{ $post->category }}</div>
      <h1 class="disp">{{ $post->title }}</h1>
      <div class="article-meta">{{ $post->read_min }} menit baca &middot; {{ optional($post->published_at)->translatedFormat('d F Y') }} &middot; VOBI Group</div>
      <div class="article-cover" style="background-image:url('{{ $post->image_url }}')"></div>
    </div>
  </header>

  <div class="wrap">
    <div class="article-body prose">
      {!! $post->body !!}

      <div class="article-share">
        <span class="form-note">Bagikan artikel ini &middot;</span>
        <a class="btn ghost" href="https://wa.me/?text={{ urlencode($post->title.' — '.url()->current()) }}" target="_blank" rel="noopener"><span>WhatsApp</span></a>
        <a class="btn ghost" href="{{ route('blog') }}"><span>&larr; Semua Artikel</span></a>
      </div>
    </div>
  </div>
</article>

@if ($related->count())
<section style="border-top:1px solid var(--line-2)">
  <div class="wrap">
    <div class="sec-head rv"><div><span class="eyebrow">Baca Juga</span><h2 class="disp">Artikel lainnya.</h2></div></div>
    <div class="related st">
      @foreach ($related as $r)
        <a class="bcard" href="{{ route('blog.show', $r) }}">
          <div class="bthumb"><div class="img" style="background-image:url('{{ $r->image_url }}')"></div></div>
          <div class="bbody"><span class="cat">{{ $r->category }}</span><h3>{{ $r->title }}</h3><span class="rd">{{ $r->read_min }} menit baca</span></div>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- CTA --}}
<section class="final">
  <div class="glow"></div>
  <div class="wrap">
    <span class="eyebrow rv" style="justify-content:center">Siap Kolaborasi?</span>
    <h2 class="disp rv">Mulai <span class="flame">bertumbuh</span> bareng VOBI.</h2>
    <div class="hero-cta rv" style="justify-content:center">
      <a class="btn solid" href="{{ route('kontak') }}"><span>Konsultasi Gratis</span></a>
      <a class="btn ghost" href="{{ route('creator') }}"><span>Lihat Marketplace</span></a>
    </div>
  </div>
</section>

@endsection
