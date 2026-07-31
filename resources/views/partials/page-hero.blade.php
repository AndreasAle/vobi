@push('head')
<script type="application/ld+json">@php
    echo json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Beranda', 'item' => route('home')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => $title, 'item' => url()->current()],
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp</script>
@endpush

<section class="page-hero">
  <div class="wrap">
    <nav class="crumb" aria-label="Breadcrumb">
      <a href="{{ route('home') }}">Beranda</a><span class="sep">/</span><span>{{ $title }}</span>
    </nav>
    @isset($eyebrow)<span class="eyebrow">{{ $eyebrow }}</span>@endisset
    <h1 class="disp">{!! $heading ?? e($title) !!}</h1>
    @isset($lead)<p class="lead">{{ $lead }}</p>@endisset
  </div>
</section>
