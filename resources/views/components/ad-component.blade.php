<div>
  {{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/components/ad-banner.blade.php --}}
@props([
    'tag' => 'SPONSORISÉ',
    'title' => 'Découvrez l’expérience DRTV',
    'subtitle' => 'Publicité • Streaming plus rapide • Qualité optimisée • Accès mobile',
    'primaryText' => 'En savoir plus',
    'primaryHref' => '#',
    'secondaryText' => 'Nous contacter',
    'secondaryHref' => null,
    'imageUrl' => null,
  ])
  
  <section class="relative overflow-hidden rounded-3xl border border-white/10 bg-dark text-white shadow-2xl">
    {{-- accents --}}
    <div class="pointer-events-none absolute inset-0">
      <div class="absolute -top-20 -left-20 h-72 w-72 rounded-full blur-3xl opacity-30"
           style="background: radial-gradient(circle, var(--accent), transparent 60%);"></div>
      <div class="absolute -bottom-20 -right-20 h-80 w-80 rounded-full blur-3xl opacity-25"
           style="background: radial-gradient(circle, var(--accent-2), transparent 60%);"></div>
      <div class="absolute inset-0 opacity-[0.06]"
           style="background-image: linear-gradient(to right, #fff 1px, transparent 1px),
                                  linear-gradient(to bottom, #fff 1px, transparent 1px);
                  background-size: 36px 36px;"></div>
      <div class="absolute inset-0"
           style="background: radial-gradient(900px 320px at 50% 20%, rgba(255,255,255,0.10), transparent 60%);"></div>
    </div>
  
    <div class="relative grid grid-cols-1 gap-8 p-7 md:grid-cols-12 md:p-10">
      <div class="md:col-span-7">
        <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-semibold text-white/90 backdrop-blur">
          <span class="inline-flex h-2 w-2 rounded-full"
                style="background: var(--accent); box-shadow: 0 0 18px var(--accent);"></span>
          <span>{{ $tag }}</span>
        </div>
  
        <h3 class="mt-4 text-2xl font-extrabold tracking-tight md:text-4xl">
          {{ $title }}
        </h3>
  
        <p class="mt-3 text-sm text-white/75 md:text-base">
          {{ $subtitle }}
        </p>
  
        <div class="mt-7 flex flex-col gap-3 sm:flex-row sm:items-center">
          <a href="{{ $primaryHref }}"
             class="inline-flex items-center justify-center rounded-full px-7 py-3 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
             style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
            {{ $primaryText }}
          </a>
  
          @if($secondaryHref)
            <a href="{{ $secondaryHref }}"
               class="inline-flex items-center justify-center rounded-full border border-white/15 bg-white/5 px-7 py-3 text-sm font-semibold text-white hover:bg-white/10 transition">
              {{ $secondaryText }}
            </a>
          @endif
        </div>
  
        <div class="mt-6 flex flex-wrap gap-2 text-xs text-white/65">
          <span class="rounded-full border border-white/10 bg-black/20 px-3 py-2">Visibilité ciblée</span>
          {{-- <span class="rounded-full border border-white/10 bg-black/20 px-3 py-2">Formats premium</span> --}}
          <span class="rounded-full border border-white/10 bg-black/20 px-3 py-2">Campagnes mesurables</span>
        </div>
      </div>
  
      <div class="md:col-span-5">
        <div class="h-full overflow-hidden rounded-2xl border border-white/10 bg-white/5 backdrop-blur">
          @if($imageUrl)
            <img src="{{ $imageUrl }}" alt="Bannière publicitaire" class="h-64 w-full object-cover md:h-full">
          @else
            <div class="relative grid h-64 place-items-center md:h-full">
              <div class="absolute inset-0 opacity-90"
                   style="background:
                     radial-gradient(700px 260px at 30% 30%, rgba(255,56,192,0.25), transparent 60%),
                     radial-gradient(700px 260px at 70% 75%, rgba(229,0,119,0.20), transparent 60%);"></div>
  
              <div class="relative text-center px-6">
                <div class="text-sm font-semibold text-white/90">Votre espace pub</div>
                <div class="mt-1 text-xs text-white/60">Intégrez ici une créa (1200×600 recommandé)</div>
                <div class="mt-5 inline-flex items-center rounded-full border border-white/10 bg-black/25 px-4 py-2 text-xs text-white/75">
                  d'autres formats disponibles
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>
</div>