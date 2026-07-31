@extends('layouts.app')

@php $type = in_array(request('type'), ['creator','brand']) ? request('type') : 'creator'; @endphp

@section('title', 'Cara Gabung VOBI — Daftar Jadi Creator atau Ajukan Brand')
@section('meta_description', 'Gabung bersama VOBI: daftar jadi creator untuk dibimbing dari nol, atau ajukan brand untuk kerjasama campaign. Prosesnya simpel, transparan, dan gratis konsultasi.')
@section('og_title', 'Cara Gabung VOBI — Untuk Creator & Brand')

@section('body')

@include('partials.page-hero', [
    'title' => 'Cara Gabung',
    'eyebrow' => 'Kolaborasi',
    'heading' => 'Dari kenalan<br>sampai cuan.',
    'lead' => 'Baik kamu kreator yang cari rumah, atau brand yang cari kreator — pintunya di sini.',
])

<section id="form">
  <div class="wrap" style="max-width:760px">

    @if (session('ok'))
      <div class="alert-ok" role="status">{{ session('ok') }}</div>
    @endif

    <div class="track-toggle rv" role="tablist" aria-label="Pilih jenis pendaftaran">
      <a href="{{ route('gabung', ['type' => 'creator']) }}#form" @class(['on' => $type === 'creator'])>Saya Creator</a>
      <a href="{{ route('gabung', ['type' => 'brand']) }}#form" @class(['on' => $type === 'brand'])>Saya Brand</a>
    </div>

    <p class="prose rv" style="margin-bottom:30px">
      @if ($type === 'creator')
        Isi data kamu dan ceritakan sedikit tentang konten yang kamu buat. Tim VOBI akan menghubungi untuk proses seleksi &amp; onboarding — <strong>non-seleb dan pemula sangat kami terima.</strong>
      @else
        Ceritakan brand dan tujuan campaign kamu. Tim kami akan bantu carikan kreator yang paling pas, lengkap dengan estimasi harga &amp; SOW.
      @endif
    </p>

    <form class="form rv" method="POST" action="{{ route('gabung.store') }}" novalidate>
      @csrf
      <input type="hidden" name="type" value="{{ $type }}">
      {{-- honeypot --}}
      <div style="position:absolute;left:-9999px" aria-hidden="true">
        <label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
      </div>

      <div class="two">
        <div class="field @error('name') bad @enderror">
          <label for="name">Nama Lengkap <span class="req">*</span></label>
          <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Nama kamu" required>
          @error('name')<div class="err">{{ $message }}</div>@enderror
        </div>
        <div class="field @error('phone') bad @enderror">
          <label for="phone">Nomor WhatsApp <span class="req">*</span></label>
          <input id="phone" type="text" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required>
          @error('phone')<div class="err">{{ $message }}</div>@enderror
        </div>
      </div>

      <div class="field @error('email') bad @enderror">
        <label for="email">Email <span class="req">*</span></label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
        @error('email')<div class="err">{{ $message }}</div>@enderror
      </div>

      <div class="field @error('subject') bad @enderror">
        <label for="subject">{{ $type === 'creator' ? 'Niche / Platform Utama' : 'Nama Brand & Kategori' }}</label>
        <input id="subject" type="text" name="subject" value="{{ old('subject') }}"
               placeholder="{{ $type === 'creator' ? 'Contoh: Beauty · TikTok' : 'Contoh: Brand A · Skincare' }}">
        @error('subject')<div class="err">{{ $message }}</div>@enderror
      </div>

      <div class="field @error('message') bad @enderror">
        <label for="message">{{ $type === 'creator' ? 'Ceritakan tentang kamu' : 'Tujuan campaign kamu' }}</label>
        <textarea id="message" name="message" placeholder="{{ $type === 'creator' ? 'Jumlah follower, pengalaman, dll (opsional)' : 'Target, budget kasar, timeline (opsional)' }}">{{ old('message') }}</textarea>
        @error('message')<div class="err">{{ $message }}</div>@enderror
      </div>

      <div style="display:flex;align-items:center;gap:20px;flex-wrap:wrap">
        <button type="submit" class="btn solid"><span>Kirim Pendaftaran &rarr;</span></button>
        <span class="form-note">Data kamu aman &amp; hanya dipakai untuk proses kerjasama.</span>
      </div>
    </form>
  </div>
</section>

@endsection
