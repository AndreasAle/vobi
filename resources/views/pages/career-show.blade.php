@extends('layouts.app')

@section('title', $career->title . ' — Career VOBI Group')
@section('meta_description', $career->excerpt)
@section('og_title', $career->title . ' — Lowongan VOBI')

@php
    $wa = $career->apply_wa ?: setting('contact_wa_seamedia', '6282185606658');
    $waMsg = 'Halo VOBI, saya ingin melamar posisi ' . $career->title . '. Berikut CV & portofolio saya.';
    $email = $career->apply_email ?: setting('contact_email', 'seamediaindonesia@gmail.com');
@endphp

@push('head')
<script type="application/ld+json">@php
    echo json_encode([
        '@context' => 'https://schema.org', '@type' => 'JobPosting',
        'title' => $career->title,
        'description' => strip_tags((string) $career->description) ?: $career->excerpt,
        'datePosted' => optional($career->posted_at)->toDateString(),
        'employmentType' => $career->type,
        'hiringOrganization' => ['@type' => 'Organization', 'name' => 'VOBI Group'],
        'jobLocation' => ['@type' => 'Place', 'address' => ['@type' => 'PostalAddress', 'addressLocality' => $career->location ?: 'Palembang', 'addressCountry' => 'ID']],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp</script>
@endpush

@section('body')

<section class="pkg-hero">
  <div class="wrap">
    <nav class="crumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Beranda</a><span class="sep">/</span><a href="{{ route('career') }}">Career</a><span class="sep">/</span><span>Posisi</span></nav>
    <div class="cr-detail-head">
      <div>
        @if ($career->unit)<span class="eyebrow">{{ $career->unit }}</span>@endif
        <h1 class="disp">{{ $career->title }}</h1>
        <div class="pkg-chips">
          <span class="pkg-chip">{{ $career->type }}</span>
          @if ($career->arrangement)<span class="pkg-chip">{{ $career->arrangement }}</span>@endif
          @if ($career->location)<span class="pkg-chip good">&#9679; {{ $career->location }}</span>@endif
          @if ($career->posted_at)<span class="pkg-chip">Dibuka {{ $career->posted_at->translatedFormat('d M Y') }}</span>@endif
        </div>
      </div>
      <a class="btn solid cr-apply-top" href="https://wa.me/{{ $wa }}?text={{ urlencode($waMsg) }}" target="_blank" rel="noopener"><span>Lamar Sekarang &rarr;</span></a>
    </div>
  </div>
</section>

<section style="padding-top:10px">
  <div class="wrap cr-detail-grid">
    <div class="cr-detail-main">
      @if ($career->description)
        <div class="prose-html rv">{!! $career->description !!}</div>
      @endif

      @if (!empty($career->requirements))
        <h3 class="cr-h3 rv">Kualifikasi</h3>
        <ul class="cr-reqs rv">
          @foreach ($career->requirements as $req)
            <li>{{ is_array($req) ? ($req['item'] ?? '') : $req }}</li>
          @endforeach
        </ul>
      @endif
    </div>

    <aside class="cr-detail-side">
      <div class="cr-apply-box rv">
        <div class="cr-apply-t">Tertarik posisi ini?</div>
        <p class="cr-apply-p">Kirim CV & portofolio kamu. Tim kami akan meninjau & menghubungi.</p>
        <a class="btn solid" href="https://wa.me/{{ $wa }}?text={{ urlencode($waMsg) }}" target="_blank" rel="noopener"><span>Lamar via WhatsApp &rarr;</span></a>
        <a class="btn ghost" href="mailto:{{ $email }}?subject={{ urlencode('Lamaran: ' . $career->title) }}"><span>Lamar via Email</span></a>
      </div>
    </aside>
  </div>
</section>

@if ($related->count())
<section class="paper">
  <div class="wrap">
    <div class="sec-head rv" style="justify-content:center;text-align:center"><div><span class="eyebrow" style="justify-content:center">Posisi Lain</span><h2 class="disp">Mungkin cocok juga.</h2></div></div>
    <div class="cr-jobs st">
      @foreach ($related as $job)
        <a class="cr-job light" href="{{ route('career.show', $job) }}">
          <div class="cr-job-top">
            @if ($job->unit)<span class="cr-unit">{{ $job->unit }}</span>@endif
            <span class="cr-go">&#8599;</span>
          </div>
          <h3 class="cr-title">{{ $job->title }}</h3>
          <p class="cr-ex">{{ $job->excerpt }}</p>
          <div class="cr-meta"><span class="cr-chip">{{ $job->type }}</span>@if($job->location)<span class="cr-chip loc">&#9679; {{ $job->location }}</span>@endif</div>
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif

@endsection
