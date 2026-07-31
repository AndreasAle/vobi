<header class="nav">
  <div class="wrap nav-in">
    <a class="brand" href="{{ route('home') }}" aria-label="VOBI beranda">
      <svg width="34" height="32" aria-hidden="true"><use href="#mark"/></svg>
      <span class="word chrome">VOBI</span>
    </a>
    <nav class="menu" aria-label="Navigasi utama">
      <a href="{{ route('ekosistem') }}" @class(['active' => request()->routeIs('ekosistem')])>Ekosistem</a>
      <a href="{{ route('layanan') }}" @class(['active' => request()->routeIs('layanan')])>Layanan</a>
      <a href="{{ route('creator') }}" @class(['active' => request()->routeIs('creator')])>Creator</a>
      <a href="{{ route('campaign') }}" @class(['active' => request()->routeIs('campaign*')])>Campaign</a>
      <a href="{{ route('blog') }}" @class(['active' => request()->routeIs('blog*')])>Blog</a>
    </nav>
    <a class="btn solid nav-cta" href="{{ route('kontak') }}"><span>Konsultasi →</span></a>
    <button class="nav-burger" id="navBurger" aria-label="Buka menu" aria-expanded="false" aria-controls="navDrawer">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<div class="nav-drawer" id="navDrawer" aria-hidden="true">
  <nav class="nav-drawer-inner" aria-label="Navigasi mobile">
    <a href="{{ route('ekosistem') }}">Ekosistem</a>
    <a href="{{ route('layanan') }}">Layanan</a>
    <a href="{{ route('creator') }}">Creator</a>
    <a href="{{ route('campaign') }}">Campaign</a>
    <a href="{{ route('blog') }}">Blog</a>
    <a class="btn solid" href="{{ route('kontak') }}"><span>Konsultasi &rarr;</span></a>
  </nav>
</div>
