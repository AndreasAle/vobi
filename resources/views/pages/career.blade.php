@extends('layouts.app')

@section('title', setting('career_seo_title', 'Career — Bergabung dengan VOBI Group | Lowongan Kerja'))
@section('meta_description', setting('career_lead', 'Bergabunglah dengan tim VOBI. Temukan posisi yang cocok — dari creator management, produksi konten, sampai teknologi.'))
@section('og_title', 'Career VOBI Group — Tumbuh Bareng Kami')

@include('partials.page-hero', [
    'title' => 'Career',
    'eyebrow' => setting('career_eyebrow', 'Bergabung'),
    'heading' => flame_text(setting('career_heading', 'Tumbuh *bareng* kami.')),
    'lead' => setting('career_lead', 'Kami rumah untuk orang yang mau berkembang. Temukan posisi yang cocok, dan mari bangun sesuatu yang berarti.'),
])

@section('body')

<section id="lowongan" style="padding-top:44px">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">Posisi Terbuka</span><h2 class="disp">{{ $careers->count() }} lowongan tersedia.</h2></div>
      <p class="r">Geser & klik posisi untuk lihat detail dan cara melamar.</p>
    </div>

    @if ($careers->count())
      <div class="cr-jobs st">
        @foreach ($careers as $job)
          <a class="cr-job" href="{{ route('career.show', $job) }}">
            <div class="cr-job-top">
              @if ($job->unit)<span class="cr-unit">{{ $job->unit }}</span>@endif
              <span class="cr-go">&#8599;</span>
            </div>
            <h3 class="cr-title">{{ $job->title }}</h3>
            <p class="cr-ex">{{ $job->excerpt }}</p>
            <div class="cr-meta">
              <span class="cr-chip">{{ $job->type }}</span>
              @if ($job->arrangement)<span class="cr-chip">{{ $job->arrangement }}</span>@endif
              @if ($job->location)<span class="cr-chip loc">&#9679; {{ $job->location }}</span>@endif
            </div>
          </a>
        @endforeach
      </div>
    @else
      <div class="cr-empty rv">
        <div class="cr-empty-ic">&#128188;</div>
        <h3>Belum ada lowongan saat ini.</h3>
        <p>Tapi kami selalu terbuka untuk talenta hebat. Kirim CV & portofoliomu — nanti kami hubungi saat ada posisi yang cocok.</p>
        <a class="btn solid" href="https://wa.me/{{ setting('contact_wa_seamedia', '6282185606658') }}?text={{ urlencode('Halo VOBI, saya tertarik bergabung dengan tim. Berikut CV & portofolio saya.') }}" target="_blank" rel="noopener"><span>Kirim CV via WhatsApp &rarr;</span></a>
      </div>
    @endif
  </div>
</section>

{{-- Kenapa VOBI --}}
<section class="paper">
  <div class="wrap">
    <div class="sec-head rv" style="justify-content:center;text-align:center">
      <div><span class="eyebrow" style="justify-content:center">Kenapa VOBI</span><h2 class="disp">Bukan sekadar kerja.</h2></div>
    </div>
    <div class="values st">
      <div class="value"><div class="vn">01</div><div class="vh">Rumah yang Tumbuh</div><div class="vp">Lingkungan suportif — dari pemula sampai profesional, semua dibimbing.</div></div>
      <div class="value"><div class="vn">02</div><div class="vh">Dampak Nyata</div><div class="vp">Kerjamu langsung berdampak ke ratusan creator & brand yang kami bantu.</div></div>
      <div class="value"><div class="vn">03</div><div class="vh">Belajar Cepat</div><div class="vp">Industri creator economy bergerak cepat — kamu ikut tumbuh di dalamnya.</div></div>
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="final">
  <div class="glow"></div>
  <div class="wrap">
    <span class="eyebrow rv" style="justify-content:center">Nggak nemu posisimu?</span>
    <h2 class="disp rv">Kenalan <span class="flame">dulu aja.</span></h2>
    <p class="rv">Kirim CV & portofolio. Kalau ada posisi yang pas, kami hubungi kamu duluan.</p>
    <div class="hero-cta rv" style="justify-content:center">
      <a class="btn solid" href="https://wa.me/{{ setting('contact_wa_seamedia', '6282185606658') }}?text={{ urlencode('Halo VOBI, saya tertarik bergabung dengan tim VOBI.') }}" target="_blank" rel="noopener"><span>Kirim CV &rarr;</span></a>
      <a class="btn ghost" href="{{ route('kontak') }}"><span>Kontak Kami</span></a>
    </div>
  </div>
</section>

@endsection
