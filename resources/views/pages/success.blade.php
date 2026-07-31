@extends('layouts.app')

@section('title', 'Success Story VOBI — Bukti Pertumbuhan Kreator & Brand')
@section('meta_description', 'Kisah sukses nyata bersama VOBI: kreator dari 500 ke 120.000 follower, brand dengan lonjakan GMV 22×, dan campaign live shopping dengan ROI 3,1×. Bukti, bukan janji.')
@section('og_title', 'Success Story VOBI — Bukti, Bukan Janji')

@section('body')

@include('partials.page-hero', [
    'title' => 'Success Story',
    'eyebrow' => 'Featured Success',
    'heading' => 'Bukti,<br>bukan janji.',
    'lead' => 'Transformasi nyata kreator, brand, dan campaign yang tumbuh bersama VOBI.',
])

{{-- Stats band --}}
<section>
  <div class="wrap">
    <div class="stats st">
      <div class="stat feat"><span class="tick">/ 01</span>
        <div class="n tnum flame" data-pre="Rp " data-c="480" data-suf="M">0</div><div class="l">GMV Generated</div></div>
      <div class="stat tall"><span class="tick">/ 02</span>
        <div class="n tnum chrome" data-c="12000" data-suf="+">0</div><div class="l">Total Creator</div></div>
      <div class="stat"><span class="tick">/ 03</span><div class="n tnum chrome" data-c="8300" data-suf="+">0</div><div class="l">Total Campaign</div></div>
      <div class="stat"><span class="tick">/ 04</span><div class="n tnum chrome" data-c="120" data-suf="K+">0</div><div class="l">Video Produced</div></div>
      <div class="stat wide"><span class="tick">/ 05</span><div class="n tnum chrome" data-c="4500" data-suf="+">0</div><div class="l">Creator Aktif</div></div>
    </div>
  </div>
</section>

{{-- Success grid --}}
<section style="padding-top:0">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">Cerita Terpilih</span><h2 class="disp">Mereka tumbuh bersama kami.</h2></div>
    </div>
    <div class="card-grid st">
      <div class="fcard"><div class="fthumb"><div class="img" data-bg="succ1"></div><span class="cat">Creator</span><span class="k flame">500 &rarr; 120K</span></div><div class="fmeta"><span class="mn">&#64;dinda.creates</span><span class="up">+240&times; follower</span></div></div>
      <div class="fcard"><div class="fthumb"><div class="img" data-bg="succ2"></div><span class="cat">Brand</span><span class="k flame">20Jt &rarr; 450Jt</span></div><div class="fmeta"><span class="mn">Brand A &middot; Skincare</span><span class="up">22&times; GMV</span></div></div>
      <div class="fcard"><div class="fthumb"><div class="img" data-bg="succ3"></div><span class="cat">Campaign</span><span class="k flame">VOBI Fest</span></div><div class="fmeta"><span class="mn">Live Shopping</span><span class="up">3,1&times; ROI</span></div></div>
      <div class="fcard"><div class="fthumb"><div class="img" data-bg="succ4"></div><span class="cat">Creator</span><span class="k flame">Top 1%</span></div><div class="fmeta"><span class="mn">&#64;razka.id</span><span class="up">Rp 210Jt GMV</span></div></div>
      <div class="fcard"><div class="fthumb"><div class="img" data-bg="eco2"></div><span class="cat">Campaign</span><span class="k flame">Ramadan Sale</span></div><div class="fmeta"><span class="mn">Multi-brand</span><span class="up">4,5&times; ROI</span></div></div>
      <div class="fcard"><div class="fthumb"><div class="img" data-bg="blog1"></div><span class="cat">Creator</span><span class="k flame">0 &rarr; Rp 80Jt</span></div><div class="fmeta"><span class="mn">&#64;bagas.tech</span><span class="up">3 bulan</span></div></div>
    </div>
  </div>
</section>

{{-- Testimonial --}}
<section id="testi">
  <div class="wrap">
    <div class="quote rv">
      <div class="ph" data-bg="test"></div>
      <div>
        <p class="serif">"Dari 500 follower jadi 120 ribu dalam 6 bulan. VOBI bukan cuma agency — mereka <span class="flame">rumah</span> yang benar-benar ngebimbing."</p>
        <div class="who"><b>Dinda A.</b> — Creator, VOBI MCN</div>
      </div>
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="final">
  <div class="glow"></div>
  <div class="wrap">
    <span class="eyebrow rv" style="justify-content:center">Giliran Kamu</span>
    <h2 class="disp rv">Tulis cerita sukses<br><span class="flame">berikutnya.</span></h2>
    <p class="rv">Mulai perjalananmu bersama VOBI hari ini.</p>
    <div class="hero-cta rv" style="justify-content:center">
      <a class="btn solid" href="{{ route('gabung') }}"><span>Cara Gabung &rarr;</span></a>
      <a class="btn ghost" href="{{ route('kontak') }}"><span>Konsultasi Gratis</span></a>
    </div>
  </div>
</section>

@endsection
