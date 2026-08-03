<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0C0A09">

    {{-- ===== SEO: Primary ===== --}}
    <title>@yield('title', setting('seo_title', 'VOBI — Talent Agency & Creator Economy untuk Brand & Kreator'))</title>
    <meta name="description" content="@yield('meta_description', setting('seo_description', 'VOBI Group: talent agency & creator economy untuk brand dan kreator. Affiliate TikTok & Shopee, produksi konten, live streaming, dan Campaign Marketplace. 12.000+ kreator aktif di 7 kota.'))">
    <meta name="keywords" content="@yield('meta_keywords', 'VOBI, talent agency, creator economy, MCN TikTok, affiliate Shopee, campaign marketplace, jasa kreator, influencer marketing Indonesia, live streaming, produksi konten')">
    <meta name="author" content="VOBI Group">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- ===== SEO: Open Graph ===== --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="VOBI Group">
    <meta property="og:locale" content="id_ID">
    <meta property="og:title" content="@yield('og_title', 'VOBI — Rumah Brand & Kreator Bertumbuh Bersama')">
    <meta property="og:description" content="@yield('og_description', 'Talent agency & creator economy: affiliate, produksi konten, live streaming, dan Campaign Marketplace. Satu ekosistem, dampak nyata.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ setting_img('seo_og_image', 'eco1') }}">

    {{-- ===== SEO: Twitter ===== --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'VOBI — Rumah Brand & Kreator Bertumbuh Bersama')">
    <meta name="twitter:description" content="@yield('og_description', 'Talent agency & creator economy untuk brand dan kreator.')">
    <meta name="twitter:image" content="{{ setting_img('seo_og_image', 'eco1') }}">

    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ctext y='.9em' font-size='90'%3E%F0%9F%A6%8B%3C/text%3E%3C/svg%3E">

    {{-- ===== Asset map + structured data ===== --}}
    @php
        $imgRoles = ['eco1','eco2','eco3','eco4','succ1','succ2','succ3','succ4','test','blog1','blog2','blog3','story','avatar',
            'vobi-team','vobi-event','vobi-event2','vobi-beauty','vobi-palette','vobi-content','vobi-web'];
        $imgMap = [];
        foreach ($imgRoles as $r) { $imgMap[$r] = asset("images/{$r}.webp"); }
        $imgMap['hero'] = asset('images/hero-poster.webp');
        $vidMap = [
            'hero'  => asset('videos/hero.mp4'),
            'card1' => asset('videos/card1.mp4'),
            'card2' => asset('videos/card2.mp4'),
            'card3' => asset('videos/card3.mp4'),
        ];
        $ld = json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'VOBI Group',
            'url' => url('/'),
            'description' => 'Talent agency & creator economy untuk brand dan kreator: affiliate TikTok & Shopee, produksi konten, live streaming, dan Campaign Marketplace.',
            'areaServed' => ['Palembang','Jakarta','Bandung','Yogyakarta','Bali','Lampung','Jambi'],
            'sameAs' => ['https://www.instagram.com/vobi.id/'],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    @endphp
    <script type="application/ld+json">{!! $ld !!}</script>

    <script>
        window.IMG = {!! json_encode($imgMap, JSON_UNESCAPED_SLASHES) !!};
        window.VID = {!! json_encode($vidMap, JSON_UNESCAPED_SLASHES) !!};
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body @class(['inner' => ! request()->routeIs('home'), 'silver' => request()->routeIs('campaign')])>
    @include('partials.svg-defs')
    @include('partials.nav')

    <main>
        @yield('body')
    </main>

    @include('partials.footer')
    @stack('scripts')
</body>
</html>
