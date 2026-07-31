@extends('layouts.app')

@section('title', $campaign->title . ' — Paket ' . $campaign->creator_name . ' | VOBI Group')
@section('meta_description', $campaign->subtitle)
@section('og_title', $campaign->title . ' — ' . $campaign->price_short)
@section('og_description', $campaign->subtitle)

@php
    $wa = $campaign->creator_name === 'VOBI MCN' ? '6289519406185' : '6282185606658';
    $waMsg = 'Halo VOBI, saya tertarik dengan paket ' . $campaign->title . ' (' . $campaign->price_short . '). Boleh info lebih lanjut?';
@endphp

@push('head')
<meta property="og:image" content="{{ asset('images/'.$campaign->image.'.webp') }}">
<script type="application/ld+json">@php
    echo json_encode([
        '@context' => 'https://schema.org', '@type' => 'Product',
        'name' => $campaign->title, 'description' => $campaign->subtitle,
        'image' => asset('images/'.$campaign->image.'.webp'), 'brand' => ['@type' => 'Brand', 'name' => $campaign->creator_name],
        'offers' => ['@type' => 'Offer', 'price' => $campaign->price, 'priceCurrency' => 'IDR', 'availability' => 'https://schema.org/InStock'],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp</script>
<script type="application/ld+json">@php
    echo json_encode([
        '@context' => 'https://schema.org', '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Campaign', 'item' => route('campaign')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $campaign->title, 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp</script>
@endpush

@section('body')

{{-- ===== Hero ===== --}}
<section class="pkg-hero">
  <div class="wrap pkg-grid">
    <div>
      <nav class="crumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Beranda</a><span class="sep">/</span><a href="{{ route('campaign') }}">Campaign</a><span class="sep">/</span><span>Paket</span></nav>
      <span class="eyebrow">{{ $campaign->category }}</span>
      <h1 class="disp">{{ $campaign->title }}</h1>
      <p class="st2">{{ $campaign->subtitle }}</p>
      <div class="pkg-chips">
        <span class="pkg-chip">{{ $campaign->creator_name }}</span>
        <span class="pkg-chip">{{ $campaign->service }}</span>
        <span class="pkg-chip good">{{ $campaign->performance }}</span>
      </div>
      <div class="pkg-price"><span class="pv tnum">{{ $campaign->price_short }}</span><span class="pk">mulai dari</span></div>
      <div class="hero-cta" style="justify-content:flex-start">
        <a class="btn solid" href="https://wa.me/{{ $wa }}?text={{ urlencode($waMsg) }}" target="_blank" rel="noopener"><span>Ajukan via WhatsApp &rarr;</span></a>
        <button class="btn ghost js-ajak" data-creator="Paket: {{ $campaign->title }}"><span>Isi Form</span></button>
      </div>
    </div>
    <div class="pkg-cover">
      <div class="img" style="background-image:url('{{ asset('images/'.$campaign->image.'.webp') }}')"></div>
    </div>
  </div>
</section>

{{-- ===== Apa yang kamu dapat ===== --}}
<section class="pkg-deliver">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">Isi Paket</span><h2 class="disp">Apa yang kamu dapat.</h2></div>
      <p class="r" style="color:#6b6157">{{ count($campaign->details) > 1 ? 'Pilih fokus yang paling pas untuk brand kamu.' : 'Semua yang kamu butuhkan, tanpa ribet.' }}</p>
    </div>
    <div class="deliver st">
      @foreach ($campaign->details as $i => $group)
        <div class="dgroup">
          <div class="dl">/ {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
          <h4>{{ $group['label'] }}</h4>
          <ul>
            @foreach ($group['items'] as $item)
              <li>{{ $item }}</li>
            @endforeach
          </ul>
        </div>
      @endforeach
    </div>
    @if ($campaign->note)
      <p class="pkg-note">{{ $campaign->note }}</p>
    @endif
  </div>
</section>

{{-- ===== Highlights ===== --}}
@if ($campaign->highlights)
<section>
  <div class="wrap">
    <div class="sec-head rv"><div><span class="eyebrow">Kenapa Paket Ini</span><h2 class="disp">Yang bikin beda.</h2></div></div>
    <div class="hl3 st">
      @foreach ($campaign->highlights as $i => $h)
        <div class="hlc"><div class="hn">/ 0{{ $i + 1 }}</div><p>{{ $h }}</p></div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ===== Cara kerja ===== --}}
<section style="border-top:1px solid var(--line-2)">
  <div class="wrap">
    <div class="sec-head rv"><div><span class="eyebrow">Cara Kerja</span><h2 class="disp">Tiga langkah, satu klik.</h2></div></div>
    <div class="values st">
      <div class="value"><div class="vn">01</div><div class="vh">Ajukan</div><div class="vp">Klik WhatsApp atau isi form singkat.</div></div>
      <div class="value"><div class="vn">02</div><div class="vh">Brief</div><div class="vp">Tim atur brief, jadwal &amp; kebutuhan.</div></div>
      <div class="value"><div class="vn">03</div><div class="vh">Jalan</div><div class="vp">Eksekusi &amp; laporan sampai selesai.</div></div>
    </div>
  </div>
</section>

{{-- ===== Paket lain ===== --}}
@if ($related->count())
<section class="paper">
  <div class="wrap">
    <div class="sec-head rv" style="justify-content:center;text-align:center"><div><span class="eyebrow" style="justify-content:center">Paket Lain</span><h2 class="disp">Masih banyak pilihan.</h2></div></div>
    <div class="cmp2-grid st">
      @foreach ($related as $cm)
        <article class="cmp2" style="background:#fff;border-color:rgba(24,19,16,.1)">
          <a class="cmp2-media" href="{{ route('campaign.show', $cm) }}">
            <span class="cmp2-cat">{{ $cm->category }}</span>
            <div class="img" style="background-image:url('{{ asset('images/'.$cm->image.'.webp') }}')"></div>
          </a>
          <div class="cmp2-body">
            <div class="cmp2-u" style="color:#8a7f73">{{ $cm->creator_name }}</div>
            <h3 style="color:var(--paper-ink)"><a href="{{ route('campaign.show', $cm) }}" style="color:inherit">{{ $cm->title }}</a></h3>
            <div class="cmp2-foot">
              <div class="pr"><small style="color:#8a7f73">Mulai dari</small><b class="tnum" style="color:var(--paper-ink)">{{ $cm->price_short }}</b></div>
              <a class="btn solid mini" href="{{ route('campaign.show', $cm) }}"><span>Detail</span></a>
            </div>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ===== CTA ===== --}}
<section class="final">
  <div class="glow"></div>
  <div class="wrap">
    <span class="eyebrow rv" style="justify-content:center">Siap Mulai?</span>
    <h2 class="disp rv">Ambil paket <span class="flame">{{ $campaign->title }}</span>.</h2>
    <p class="rv">Konsultasi dulu gratis — tim kami bantu sesuaikan dengan kebutuhanmu.</p>
    <div class="hero-cta rv" style="justify-content:center">
      <a class="btn solid" href="https://wa.me/{{ $wa }}?text={{ urlencode($waMsg) }}" target="_blank" rel="noopener"><span>Ajukan via WhatsApp &rarr;</span></a>
      <a class="btn ghost" href="{{ route('campaign') }}"><span>Lihat Paket Lain</span></a>
    </div>
  </div>
</section>

{{-- ===== Modal Ajak ===== --}}
<div class="modal" id="ajakModal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Ajukan paket">
  <div class="modal-bg" data-close></div>
  <div class="modal-box">
    <button class="mclose" data-close aria-label="Tutup">&times;</button>
    <h3>Ajukan Paket</h3>
    <p class="msub">Tertarik dengan <b>{{ $campaign->title }}</b>? Isi data singkat — tim kami yang lanjutkan.</p>
    <form class="form" method="POST" action="{{ route('creator.ajak') }}">
      @csrf
      <input type="hidden" name="creator" value="Paket: {{ $campaign->title }}">
      <input type="text" name="website" value="" style="display:none" tabindex="-1" autocomplete="off" aria-hidden="true">
      <div class="field @error('name') bad @enderror"><label>Nama <span class="req">*</span></label><input type="text" name="name" value="{{ old('name') }}" placeholder="Nama kamu" required>@error('name')<div class="err">{{ $message }}</div>@enderror</div>
      <div class="field"><label>Brand / Perusahaan</label><input type="text" name="brand" value="{{ old('brand') }}" placeholder="Nama brand (opsional)"></div>
      <div class="two">
        <div class="field @error('email') bad @enderror"><label>Email <span class="req">*</span></label><input type="email" name="email" value="{{ old('email') }}" placeholder="email@brand.com" required>@error('email')<div class="err">{{ $message }}</div>@enderror</div>
        <div class="field @error('phone') bad @enderror"><label>WhatsApp <span class="req">*</span></label><input type="text" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required>@error('phone')<div class="err">{{ $message }}</div>@enderror</div>
      </div>
      <div class="field"><label>Catatan</label><textarea name="message" placeholder="Ceritakan kebutuhan kamu...">{{ old('message') }}</textarea></div>
      <button class="btn solid" type="submit"><span>Kirim Permintaan &rarr;</span></button>
    </form>
  </div>
</div>

@if (session('ok'))
  <div class="alert-ok" style="position:fixed;bottom:20px;left:50%;transform:translateX(-50%);z-index:300;max-width:90%">{{ session('ok') }}</div>
@endif

@push('scripts')
<script>
(function(){
  var modal = document.getElementById('ajakModal');
  function open(){ modal.classList.add('open'); document.body.style.overflow='hidden'; }
  function close(){ modal.classList.remove('open'); document.body.style.overflow=''; }
  document.querySelectorAll('.js-ajak').forEach(function(b){ b.addEventListener('click', open); });
  modal.querySelectorAll('[data-close]').forEach(function(x){ x.addEventListener('click', close); });
  document.addEventListener('keydown', function(e){ if(e.key==='Escape') close(); });
  @if($errors->any() && old('creator'))
    open();
  @endif
})();
</script>
@endpush

@endsection
