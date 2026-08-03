@php
    $waVobi = setting('contact_wa_vobi', '6289519406185');
    $waSea  = setting('contact_wa_seamedia', '6282185606658');
    $email  = setting('contact_email', 'seamediaindonesia@gmail.com');
    $addr   = setting('contact_address', 'Palembang, Sumatera Selatan');

    // Kolom footer: pakai dari admin bila ada, else default hardcoded.
    $footerCols = setting_arr('footer_columns', [
        ['title' => 'Ekosistem', 'links' => [
            ['label' => 'VOBI MCN', 'url' => route('ekosistem')],
            ['label' => 'TikTok Affiliate (TAP)', 'url' => route('layanan')],
            ['label' => 'SEAMEDIA', 'url' => route('ekosistem')],
            ['label' => 'Conversion Web', 'url' => route('creator')],
        ]],
        ['title' => 'Kolaborasi', 'links' => [
            ['label' => 'Jadi Creator', 'url' => route('gabung')],
            ['label' => 'Jadi Brand / Seller', 'url' => route('gabung')],
            ['label' => 'Campaign Marketplace', 'url' => route('creator')],
            ['label' => 'Layanan & Paket', 'url' => route('layanan')],
        ]],
    ]);
@endphp
<footer>
  <div class="wrap">
    <div class="foot-top">
      <div class="col">
        <a class="brand" href="{{ route('home') }}" aria-label="VOBI beranda">
          <svg width="34" height="32" aria-hidden="true"><use href="#mark"/></svg>
          <span class="word chrome">VOBI</span>
        </a>
        <p class="lead">{{ setting('footer_tagline', 'A Home Change Everything. Membangun bisnis & kreator bertumbuh bersama.') }}</p>
      </div>
      @foreach ($footerCols as $col)
        <div class="col">
          <b>{{ $col['title'] ?? '' }}</b>
          @foreach ($col['links'] ?? [] as $link)
            <a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a>
          @endforeach
        </div>
      @endforeach
      <div class="col">
        <b>Kontak</b>
        <a href="https://wa.me/{{ $waVobi }}">WA VOBI MCN &middot; {{ setting('contact_wa_vobi_display', '0895-1940-6185') }}</a>
        <a href="https://wa.me/{{ $waSea }}">WA SEAMEDIA &middot; {{ setting('contact_wa_seamedia_display', '0821-8560-6658') }}</a>
        <a href="mailto:{{ $email }}">{{ $email }}</a>
        <a href="{{ route('kontak') }}">{{ $addr }}</a>
      </div>
    </div>
    <div class="foot-bottom">
      <span>&copy; {{ date('Y') }} {{ setting('footer_copyright', 'V.O.B.I. Group — All rights reserved.') }}</span>
      <span>
        @php
            $ig = setting('social_instagram'); $tt = setting('social_tiktok'); $yt = setting('social_youtube');
        @endphp
        @if($ig || $tt || $yt)
          @if($ig)<a href="{{ $ig }}" target="_blank" rel="noopener">Instagram</a>@endif
          @if($tt) &middot; <a href="{{ $tt }}" target="_blank" rel="noopener">TikTok</a>@endif
          @if($yt) &middot; <a href="{{ $yt }}" target="_blank" rel="noopener">YouTube</a>@endif
        @else
          Instagram &middot; TikTok &middot; YouTube
        @endif
      </span>
    </div>
  </div>
</footer>
