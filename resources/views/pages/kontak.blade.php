@extends('layouts.app')

@section('title', 'Kontak VOBI — Konsultasi Gratis untuk Brand & Kreator')
@section('meta_description', 'Hubungi VOBI Group untuk konsultasi gratis. Kantor di Palembang (Perumahan Bakung Palace, Sako). WhatsApp VOBI MCN & SEAMEDIA, email seamediaindonesia@gmail.com — tim kami siap bantu talent, brand, dan UMKM bertumbuh.')
@section('og_title', 'Kontak VOBI — Mari Bicara')

@section('body')

@include('partials.page-hero', [
    'title' => 'Kontak',
    'eyebrow' => 'Contact Us',
    'heading' => 'Mari tumbuh<br><span class="flame">bersama</span> kami.',
    'lead' => 'Brand mencari kreator? Kreator mencari rumah? Ceritakan ke kami — konsultasi gratis.',
])

<section id="form">
  <div class="wrap contact-grid">

    {{-- Info --}}
    <div class="rv">
      <span class="eyebrow">Info</span>
      <div style="margin-top:22px">
        <div class="info-item"><div class="k">Kantor Pusat</div><div class="v">Perumahan Bakung Palace, Blk B No. 10,<br>Kec. Sako, Kota Palembang, Sumatera Selatan</div></div>
        <div class="info-item"><div class="k">WhatsApp &middot; VOBI MCN</div><div class="v"><a href="https://wa.me/6289519406185">0895-1940-6185 (Nadia)</a> &middot; <a href="https://wa.me/6285964424804">0859-6442-4804 (Selvi)</a></div></div>
        <div class="info-item"><div class="k">WhatsApp &middot; SEAMEDIA</div><div class="v"><a href="https://wa.me/6282185606658">0821-8560-6658 (Agung)</a> &middot; <a href="https://wa.me/6289675280180">0896-7528-0180 (Keyla)</a> &middot; <a href="https://wa.me/6282180682941">0821-8068-2941 (Adit)</a></div></div>
        <div class="info-item"><div class="k">Email</div><div class="v"><a href="mailto:seamediaindonesia&#64;gmail.com">seamediaindonesia&#64;gmail.com</a></div></div>
        <div class="info-item"><div class="k">Instagram</div><div class="v"><a href="https://www.instagram.com/vobi.id/" rel="noopener" target="_blank">&#64;vobi.id</a></div></div>
        <div class="info-item"><div class="k">Jam Operasional</div><div class="v">Senin&ndash;Sabtu, 09.00&ndash;18.00 WIB</div></div>
      </div>
    </div>

    {{-- Form --}}
    <div class="rv">
      <span class="eyebrow">Kirim Pesan</span>

      @if (session('ok'))
        <div class="alert-ok" role="status" style="margin-top:22px">{{ session('ok') }}</div>
      @endif

      <form class="form" method="POST" action="{{ route('kontak.store') }}" novalidate style="margin-top:22px;max-width:none">
        @csrf
        <div style="position:absolute;left:-9999px" aria-hidden="true">
          <label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
        </div>

        <div class="two">
          <div class="field @error('name') bad @enderror">
            <label for="cname">Nama <span class="req">*</span></label>
            <input id="cname" type="text" name="name" value="{{ old('name') }}" placeholder="Nama kamu" required>
            @error('name')<div class="err">{{ $message }}</div>@enderror
          </div>
          <div class="field @error('phone') bad @enderror">
            <label for="cphone">WhatsApp</label>
            <input id="cphone" type="text" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
            @error('phone')<div class="err">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="field @error('email') bad @enderror">
          <label for="cemail">Email <span class="req">*</span></label>
          <input id="cemail" type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
          @error('email')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div class="field @error('subject') bad @enderror">
          <label for="csubject">Subjek</label>
          <input id="csubject" type="text" name="subject" value="{{ old('subject') }}" placeholder="Contoh: Kerjasama campaign / Jadi creator">
          @error('subject')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div class="field @error('message') bad @enderror">
          <label for="cmessage">Pesan <span class="req">*</span></label>
          <textarea id="cmessage" name="message" placeholder="Ceritakan kebutuhan kamu..." required>{{ old('message') }}</textarea>
          @error('message')<div class="err">{{ $message }}</div>@enderror
        </div>

        <div style="display:flex;align-items:center;gap:20px;flex-wrap:wrap">
          <button type="submit" class="btn solid"><span>Kirim Pesan &rarr;</span></button>
          <span class="form-note">Kami balas maksimal 1&times;24 jam kerja.</span>
        </div>
      </form>
    </div>
  </div>
</section>

@endsection
