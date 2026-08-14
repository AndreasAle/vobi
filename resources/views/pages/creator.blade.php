@extends('layouts.app')

@section('title', 'Creator VOBI — Katalog Talent & Performa TikTok')
@section('meta_description', 'Katalog kreator terverifikasi VOBI: lihat followers, engagement, GMV 3 bulan, tier, dan harga kerjasama. Pilih kreator unggulan atau jelajahi daftar lengkap — satu klik, tim kami lanjutkan.')
@section('og_title', 'Creator VOBI — Katalog Talent Terverifikasi')

@push('head')
<script type="application/ld+json">@php
    echo json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Creator', 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp</script>
@endpush

@php
    // sparkline deterministik per kreator (dekoratif, tren naik)
    $spark = function ($seed) {
        mt_srand((int) $seed); $y = 30; $p = [];
        for ($i = 0; $i < 9; $i++) { $y = max(4, min(36, $y - mt_rand(-4, 7))); $p[] = ($i * 12) . ',' . $y; }
        return implode(' ', $p);
    };
    $featIds = $featured->pluck('id');
    $others = $creators->reject(fn ($c) => $featIds->contains($c->id))->values();

    // data kreator untuk popup detail (angka + tren)
    $creatorData = $creators->mapWithKeys(function ($c) {
        mt_srand(crc32($c->slug));
        $base = max(1, intval($c->gmv_3m / 6));
        $trend = []; $v = intval($base * 0.5);
        for ($i = 0; $i < 6; $i++) { $v = max(1, intval($v + $base * (0.35 + mt_rand(0, 55) / 100))); $trend[] = $v; }
        $growth = end($trend) > 0 && $trend[0] > 0 ? round((end($trend) - $trend[0]) / $trend[0] * 100) : 0;
        return [$c->id => [
            'name' => $c->name, 'handle' => $c->handle, 'tier' => $c->tier,
            'cat' => $c->category, 'platform' => $c->platform, 'city' => $c->city,
            'followers' => $c->followers_short, 'eng' => number_format($c->engagement_rate, 1, ',', '') . '%',
            'gmv' => $c->gmv_short, 'price' => $c->price_short,
            'avatar' => $c->avatar_url,
            'trend' => $trend, 'growth' => $growth,
        ]];
    });
@endphp

@section('body')

<section class="mk-hero">
  <div class="wrap">
    <nav class="crumb" aria-label="Breadcrumb"><a href="{{ route('home') }}">Beranda</a><span class="sep">/</span><span>Creator</span></nav>
    <span class="eyebrow">Katalog Talent</span>
    <h1 class="disp">Pilih kreator, <span class="flame">lihat performa</span>, ajak kerjasama.</h1>
    <p class="lead2">Katalog kreator terverifikasi VOBI — lengkap dengan kategori, harga, dan performa 3 bulan terakhir. Semua data di-input &amp; dijaga tim kami.</p>
  </div>
</section>

{{-- ===== Kreator Unggulan ===== --}}
<section id="katalog">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">Kreator Unggulan</span><h2 class="disp">Talent pilihan.</h2></div>
      <a class="avstack" href="#daftar" aria-label="Lihat semua kreator lainnya">
        @foreach ($others->take(3) as $o)
          <span class="a" style="background-image:url('{{ $o->avatar_url }}')"></span>
        @endforeach
        <span class="more">@if($others->count() > 3)+{{ $others->count()-3 }}@else&rarr;@endif</span>
        <span class="cap">kreator lainnya</span>
      </a>
    </div>

    @if (session('ok'))
      <div class="alert-ok" style="margin-bottom:24px">{{ session('ok') }}</div>
    @endif

    <div class="feat-cr st">
      @foreach ($featured as $cr)
        <article class="fcr">
          <div class="fm" data-detail="{{ $cr->id }}" role="button" tabindex="0" aria-label="Detail {{ $cr->name }}">
            <span class="rib">&#9733; Unggulan</span>
            <div class="fi" style="background-image:url('{{ $cr->avatar_url }}')"></div>
            <div class="fnm"><div class="n">{{ $cr->name }}</div><div class="h">{{ $cr->handle }} &middot; {{ $cr->category }}</div></div>
          </div>
          <div class="fb">
            <div class="fstat"><div class="big tnum">{{ $cr->gmv_short }}</div><div class="k">GMV<br>3 bulan</div></div>
            <div class="fmini">
              <div><div class="v tnum">{{ $cr->followers_short }}</div><div class="k">Followers</div></div>
              <div><div class="v up tnum">{{ number_format($cr->engagement_rate,1,',','') }}%</div><div class="k">Eng.</div></div>
              <div><div class="v tnum">{{ $cr->platform }}</div><div class="k">Platform</div></div>
            </div>
            <div class="frow">
              <div class="p"><div class="k">Mulai dari</div><div class="v tnum">{{ $cr->price_short }}</div></div>
              <button class="btn solid mini js-ajak" data-creator="{{ $cr->name }}"><span>Ajak Kerjasama</span></button>
            </div>
          </div>
        </article>
      @endforeach
    </div>
  </div>
</section>

{{-- ===== Semua Kreator (tabel) ===== --}}
<section style="padding-top:0" id="daftar">
  <div class="wrap">
    <div class="sec-head rv">
      <div><span class="eyebrow">Daftar Lengkap</span><h2 class="disp">Semua kreator.</h2></div>
      <div class="mk-search">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
        <input type="search" id="mkSearch" placeholder="Cari nama kreator..." aria-label="Cari kreator">
      </div>
    </div>

    <div class="mk-filters rv" id="mkFilters" style="margin-bottom:22px">
      <div class="mk-fgroup"><span class="mk-fglabel">Platform</span>
        @foreach ($platforms as $p)<span class="chip-f" data-group="platform" data-value="{{ $p }}">{{ $p }}</span>@endforeach
      </div>
      <div class="mk-fgroup"><span class="mk-fglabel">Kategori</span>
        @foreach ($categories as $c)<span class="chip-f" data-group="category" data-value="{{ $c }}">{{ $c }}</span>@endforeach
      </div>
      <span class="mk-count" id="mkCount" style="margin-left:auto"></span>
    </div>

    <div class="crx rv" id="crxTable">
      <div class="crx-head">
        <div>Kreator</div><div>Followers</div><div>Eng.</div><div>GMV 3bln</div><div>Tren</div><div>Harga</div><div></div>
      </div>
      @foreach ($creators as $cr)
        <div class="crx-row js-item"
             data-name="{{ Str::lower($cr->name) }}"
             data-platform="{{ $cr->platform }}"
             data-category="{{ $cr->category }}"
             data-tier="{{ $cr->tier }}">
          <div class="crx-cr" data-detail="{{ $cr->id }}" role="button" tabindex="0" aria-label="Detail {{ $cr->name }}">
            <div class="crx-av" style="background-image:url('{{ $cr->avatar_url }}')"></div>
            <div style="min-width:0">
              <div class="nm">{{ $cr->name }}</div>
              <div class="hd">{{ $cr->handle }} &middot; {{ $cr->category }} &middot; {{ $cr->city }}</div>
            </div>
          </div>
          <div class="crx-c" data-l="Followers"><span class="v tnum">{{ $cr->followers_short }}</span></div>
          <div class="crx-c" data-l="Eng."><span class="v up tnum">{{ number_format($cr->engagement_rate,1,',','') }}%</span></div>
          <div class="crx-c gmv" data-l="GMV 3bln"><span class="v tnum">{{ $cr->gmv_short }}</span></div>
          <div class="crx-c trend" data-l="Tren">
            <svg class="crx-spark" viewBox="0 0 96 40" fill="none" aria-hidden="true"><polyline points="{{ $spark(crc32($cr->slug)) }}" stroke="var(--good)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </div>
          <div class="crx-c price" data-l="Harga"><span class="v tnum">{{ $cr->price_short }}</span><span class="sub">mulai dari</span></div>
          <div class="crx-c crx-act"><button class="btn solid mini js-ajak" data-creator="{{ $cr->name }}"><span>Ajak</span></button></div>
        </div>
      @endforeach
      <div class="mk-empty" id="crEmpty" style="display:none;padding:50px 0">Tidak ada kreator yang cocok. Coba reset filter.</div>
    </div>
  </div>
</section>


{{-- ===== How it works ===== --}}
<section class="paper">
  <div class="wrap">
    <div class="sec-head rv" style="justify-content:center;text-align:center">
      <div><span class="eyebrow" style="justify-content:center">Cara Kerja</span><h2 class="disp">Tiga langkah, satu klik.</h2></div>
    </div>
    <div class="values st">
      <div class="value"><div class="vn">01</div><div class="vh">Jelajahi</div><div class="vp">Filter sesuai platform, kategori &amp; kebutuhan.</div></div>
      <div class="value"><div class="vn">02</div><div class="vh">Ajak</div><div class="vp">Klik kreator, isi form singkat.</div></div>
      <div class="value"><div class="vn">03</div><div class="vh">Jalan</div><div class="vp">Tim kami atur sampai selesai.</div></div>
    </div>
  </div>
</section>

{{-- ===== Modal: Detail Kreator ===== --}}
<div class="modal" id="creatorModal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Detail kreator">
  <div class="modal-bg" data-cclose></div>
  <div class="modal-box wide">
    <button class="mclose" data-cclose aria-label="Tutup">&times;</button>
    <div class="cm-head">
      <div class="cm-av" id="cmAv"></div>
      <div>
        <div class="cm-name"><span id="cmName"></span></div>
        <div class="cm-sub" id="cmSub"></div>
      </div>
    </div>
    <div class="cm-chart">
      <div class="ct"><span>Tren GMV &middot; 6 bulan</span><span class="up" id="cmGrowth"></span></div>
      <svg id="cmChart" viewBox="0 0 300 130" preserveAspectRatio="none" aria-hidden="true"></svg>
    </div>
    <div class="cm-stats">
      <div class="cm-stat"><div class="v" id="cmFoll"></div><div class="k">Followers</div></div>
      <div class="cm-stat"><div class="v up" id="cmEng"></div><div class="k">Eng. Rate</div></div>
      <div class="cm-stat"><div class="v gmv" id="cmGmv"></div><div class="k">GMV 3bln</div></div>
      <div class="cm-stat"><div class="v" id="cmPrice"></div><div class="k">Harga mulai</div></div>
    </div>
    <div class="cm-cta">
      <button class="btn solid" id="cmAjak"><span>Ajak Kerjasama &rarr;</span></button>
    </div>
  </div>
</div>

{{-- ===== Modal: Ajak ===== --}}
<div class="modal" id="ajakModal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Ajak kerjasama">
  <div class="modal-bg" data-close></div>
  <div class="modal-box">
    <button class="mclose" data-close aria-label="Tutup">&times;</button>
    <h3>Ajak Kerjasama</h3>
    <p class="msub">Kolaborasi dengan <b id="ajakCreatorLabel">kreator</b>. Isi data singkat — tim kami yang lanjutkan.</p>
    <form class="form" method="POST" action="{{ route('creator.ajak') }}">
      @csrf
      <input type="hidden" name="creator" id="ajakCreator" value="{{ old('creator') }}">
      <input type="text" name="website" value="" style="display:none" tabindex="-1" autocomplete="off" aria-hidden="true">
      <div class="field @error('name') bad @enderror"><label>Nama <span class="req">*</span></label><input type="text" name="name" value="{{ old('name') }}" placeholder="Nama kamu" required>@error('name')<div class="err">{{ $message }}</div>@enderror</div>
      <div class="field"><label>Brand / Perusahaan</label><input type="text" name="brand" value="{{ old('brand') }}" placeholder="Nama brand (opsional)"></div>
      <div class="two">
        <div class="field @error('email') bad @enderror"><label>Email <span class="req">*</span></label><input type="email" name="email" value="{{ old('email') }}" placeholder="email@brand.com" required>@error('email')<div class="err">{{ $message }}</div>@enderror</div>
        <div class="field @error('phone') bad @enderror"><label>WhatsApp <span class="req">*</span></label><input type="text" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required>@error('phone')<div class="err">{{ $message }}</div>@enderror</div>
      </div>
      <div class="field"><label>Brief singkat</label><textarea name="message" placeholder="Ceritakan produk & tujuan campaign kamu...">{{ old('message') }}</textarea></div>
      <button class="btn solid" type="submit"><span>Kirim Permintaan &rarr;</span></button>
      <p class="form-note">Dengan mengirim, kamu setuju tim VOBI menghubungi via email/WhatsApp.</p>
    </form>
  </div>
</div>

@push('scripts')
<script>
(function(){
  // ---- filter + search (tabel) ----
  var active = { platform:new Set(), category:new Set() };
  document.querySelectorAll('.chip-f').forEach(function(chip){
    chip.addEventListener('click', function(){
      var g = chip.dataset.group, v = chip.dataset.value;
      if(active[g].has(v)){ active[g].delete(v); chip.classList.remove('on'); }
      else { active[g].add(v); chip.classList.add('on'); }
      apply();
    });
  });
  var search = document.getElementById('mkSearch');
  if(search) search.addEventListener('input', apply);
  var countEl = document.getElementById('mkCount');
  var rows = [].slice.call(document.querySelectorAll('.crx-row.js-item'));

  function apply(){
    var q = (search ? search.value : '').trim().toLowerCase(); var shown = 0;
    rows.forEach(function(r){
      var ok = true;
      if(q && r.dataset.name.indexOf(q) === -1) ok = false;
      for(var g in active){ if(ok && active[g].size && !active[g].has(r.dataset[g])) ok = false; }
      r.classList.toggle('hidden-card', !ok); if(ok) shown++;
    });
    if(countEl) countEl.textContent = shown + ' kreator';
    var emp = document.getElementById('crEmpty'); if(emp) emp.style.display = shown===0 ? 'block' : 'none';
  }
  apply();

  // ---- modal ----
  var modal = document.getElementById('ajakModal');
  var label = document.getElementById('ajakCreatorLabel');
  var input = document.getElementById('ajakCreator');
  function openModal(name){ input.value = name; label.textContent = name; modal.classList.add('open'); document.body.style.overflow='hidden'; }
  function closeModal(){ modal.classList.remove('open'); document.body.style.overflow=''; }
  document.querySelectorAll('.js-ajak').forEach(function(b){ b.addEventListener('click', function(e){ e.stopPropagation(); openModal(b.dataset.creator); }); });
  modal.querySelectorAll('[data-close]').forEach(function(x){ x.addEventListener('click', closeModal); });
  document.addEventListener('keydown', function(e){ if(e.key==='Escape'){ closeModal(); closeCreator(); } });
  @if($errors->any() && old('creator'))
    openModal(@json(old('creator')));
  @endif

  // ---- creator detail modal ----
  var DATA = {!! json_encode($creatorData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!};
  var cModal = document.getElementById('creatorModal');
  var $ = function(id){ return document.getElementById(id); };
  var curName = '';

  function renderChart(trend){
    var W=300,H=130,pad=10,topPad=16,n=trend.length;
    var max=Math.max.apply(null,trend), min=Math.min.apply(null,trend);
    var xx=function(i){ return pad + i*(W-2*pad)/(n-1); };
    var yy=function(v){ var t=(v-min)/((max-min)||1); return (H-pad) - t*(H-pad-topPad); };
    var pts=trend.map(function(v,i){ return xx(i).toFixed(1)+','+yy(v).toFixed(1); });
    var line='M'+pts.join(' L');
    var area=line+' L'+xx(n-1).toFixed(1)+','+(H-pad)+' L'+xx(0).toFixed(1)+','+(H-pad)+' Z';
    $('cmChart').innerHTML =
      '<defs><linearGradient id="cmg" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="rgba(217,138,68,.38)"/><stop offset="1" stop-color="rgba(217,138,68,0)"/></linearGradient></defs>'+
      '<path d="'+area+'" fill="url(#cmg)"/>'+
      '<path d="'+line+'" fill="none" stroke="#E4A860" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" vector-effect="non-scaling-stroke"/>'+
      '<circle cx="'+xx(n-1).toFixed(1)+'" cy="'+yy(trend[n-1]).toFixed(1)+'" r="4" fill="#E7C88C"/>';
  }
  function openCreator(id){
    var d = DATA[id]; if(!d) return;
    curName = d.name;
    $('cmAv').style.backgroundImage = "url('"+d.avatar+"')";
    $('cmName').textContent = d.name;
    $('cmSub').textContent = d.handle + ' · ' + d.cat + ' · ' + d.platform + ' · ' + d.city;
    $('cmGrowth').textContent = (d.growth>0?'↑ ':'') + d.growth + '% growth';
    $('cmFoll').textContent = d.followers;
    $('cmEng').textContent = d.eng;
    $('cmGmv').textContent = d.gmv;
    $('cmPrice').textContent = d.price;
    renderChart(d.trend);
    cModal.classList.add('open'); document.body.style.overflow='hidden';
  }
  function closeCreator(){ cModal.classList.remove('open'); document.body.style.overflow=''; }

  document.querySelectorAll('[data-detail]').forEach(function(el){
    el.addEventListener('click', function(){ openCreator(el.dataset.detail); });
    el.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); openCreator(el.dataset.detail); } });
  });
  cModal.querySelectorAll('[data-cclose]').forEach(function(x){ x.addEventListener('click', closeCreator); });
  $('cmAjak').addEventListener('click', function(){ closeCreator(); openModal(curName); });
})();
</script>
@endpush

@endsection
