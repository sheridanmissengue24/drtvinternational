{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/components/header.blade.php --}}
<header class="sticky top-0 z-50 bg-dark/85 backdrop-blur ring-1 ring-white/10">
  <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between gap-4">
    <a href="{{ route('home') }}" class="flex items-center gap-3">
      <img src="{{ asset('images/logo.png') }}" alt="DRTV" class="h-10 object-contain">
    </a>

    <nav class="hidden md:flex items-center gap-6 text-sm font-semibold">
      <a href="{{ route('home') }}" class="text-white/80 hover:text-white transition">Accueil</a>
      <a href="{{ route('actualites.index') }}" class="text-white/80 hover:text-white transition">Actualités</a>
      {{-- <a href="{{ route('emissions.index') }}" class="text-white/80 hover:text-white transition">Emissions</a> --}}
      <a href="{{ route('productions.index') }}" class="text-white/80 hover:text-white transition">Productions</a>
      <a href="{{ route('programme.index') }}" class="text-white/80 hover:text-white transition">Programmes</a>
      <a href="{{ route('live.tv') }}" class="text-white/80 hover:text-white transition">Live TV</a>
      {{-- <a href="{{ route('vod.index') }}" class="text-white/80 hover:text-white transition">VOD</a> --}}
      {{-- <a href="#" class="text-white/80 hover:text-white transition">Podcasts</a> --}}
      <a href="{{ route('contact.index') }}" class="ml-4 px-4 py-2 rounded-2xl btn-primary ring-1 ring-white/10">
        Contact
      </a>
    </nav>

    <!-- mobile actions -->
    <div class="md:hidden flex items-center gap-2">
      <button id="mobile-search-toggle"
              class="p-2 rounded-2xl bg-white/8 ring-1 ring-white/10 text-white/90 hover:bg-white/12 transition"
              aria-label="search">🔍</button>
      <button id="menu-toggle"
              class="p-2 rounded-2xl bg-white/8 ring-1 ring-white/10 text-white/90 hover:bg-white/12 transition">☰</button>
    </div>
  </div>

  <!-- mobile search -->
  <div id="mobile-search" class="hidden px-4 pb-4 md:hidden">
    <div class="rounded-3xl overflow-hidden ring-1 ring-white/10 backdrop-blur drtv-glow"
         style="background: linear-gradient(135deg, rgba(229,0,119,0.18), rgba(244,13,171,0.10) 45%, rgba(7,3,6,0.70));">
      <div class="p-3">
        <form action="{{ route('home') }}" method="GET" class="flex gap-2">
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher..."
                 class="flex-1 px-3 py-2 rounded-2xl bg-black/30 text-white placeholder:text-white/40 ring-1 ring-white/10 outline-none
                        focus:ring-2 focus:ring-[var(--accent)]" />
          <button type="submit" class="px-4 py-2 rounded-2xl btn-primary ring-1 ring-white/10">OK</button>
        </form>
      </div>
    </div>
  </div>

  <!-- mobile nav -->
  <div id="mobile-nav" class="px-4 pb-4 hidden md:hidden">
    <div class="rounded-3xl overflow-hidden ring-1 ring-white/10 backdrop-blur drtv-glow"
         style="background: linear-gradient(135deg, rgba(229,0,119,0.18), rgba(244,13,171,0.10) 45%, rgba(7,3,6,0.72));">
      <a href="{{ route('home') }}"
         class="block px-4 py-3 text-white/90 hover:bg-white/8 transition border-b border-white/10">
        Accueil
      </a>
      <a href="{{ route('actualites.index') }}"
         class="block px-4 py-3 text-white/90 hover:bg-white/8 transition border-b border-white/10">
        Actualités
      </a>
      <a href="{{ route('productions.index') }}"
         class="block px-4 py-3 text-white/90 hover:bg-white/8 transition border-b border-white/10">
        Productions
      </a>
      <a href="{{ route('programme.index') }}"
         class="block px-4 py-3 text-white/90 hover:bg-white/8 transition border-b border-white/10">
        Programmes
      </a>
      <a href="{{ route('live.tv') }}"
         class="block px-4 py-3 text-white/90 hover:bg-white/8 transition border-b border-white/10">
        Live TV
      </a>
      <a href="{{ route('contact.index') }}"
         class="block px-4 py-3 text-white/95 hover:bg-white/8 transition">
        <span class="inline-flex items-center justify-center rounded-2xl px-4 py-2 btn-primary ring-1 ring-white/10">
          Contact
        </span>
      </a>
    </div>
  </div>
</header>