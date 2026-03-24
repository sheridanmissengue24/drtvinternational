{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/pages/actualites/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Actualités')

@section('content')
@php
  // attentes: $actualites (paginé), $categories (collection), optionnel: $activeCategory (Category|null)
  $activeCategoryId = (string) request('category', '');
  $q = (string) request('q', '');
@endphp

{{-- HERO (charte DRTV) --}}
<section class="relative overflow-hidden bg-dark text-white">
  <div class="pointer-events-none absolute inset-0">
    <div class="absolute -top-24 -left-24 h-80 w-80 rounded-full blur-3xl opacity-30"
         style="background: radial-gradient(circle, var(--accent), transparent 60%);"></div>
    <div class="absolute -bottom-24 -right-24 h-96 w-96 rounded-full blur-3xl opacity-25"
         style="background: radial-gradient(circle, var(--accent-2), transparent 60%);"></div>

    <div class="absolute inset-0 opacity-[0.06]"
         style="background-image: linear-gradient(to right, #fff 1px, transparent 1px),
                                linear-gradient(to bottom, #fff 1px, transparent 1px);
                background-size: 32px 32px;"></div>

    <div class="absolute inset-0"
         style="background: radial-gradient(900px 360px at 50% 18%, rgba(255,255,255,0.10), transparent 62%);"></div>
  </div>

  <div class="relative max-w-7xl mx-auto px-6 py-14 md:py-20">
    <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-sm">
      <span class="inline-flex h-2 w-2 rounded-full"
            style="background: var(--accent); box-shadow: 0 0 18px var(--accent);"></span>
      <span class="font-medium tracking-wide">ACTUALITÉS</span>
      <span class="text-white/60">• DRTV</span>
    </div>

    <h1 class="mt-5 text-4xl font-extrabold tracking-tight sm:text-5xl">
      Actualités 
    </h1>
    <p class="mt-3 max-w-2xl text-white/70">
      Consultez les dernières informations.
    </p>

    {{-- Filters --}}
    <div class="mt-8 flex flex-col gap-4">
      <form method="GET" class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex flex-wrap items-center gap-2">
          <a href="{{ route('actualites.index', array_filter(['q' => $q])) }}"
             class="inline-flex items-center rounded-full border px-4 py-2 text-xs font-semibold transition
                    {{ $activeCategoryId==='' ? 'border-white/20 bg-white/10 text-white' : 'border-white/10 bg-black/20 text-white/80 hover:bg-white/10' }}">
            Toutes
          </a>

          @foreach(($categories ?? collect()) as $cat)
            <a href="{{ route('actualites.index', array_filter(['category' => $cat->id, 'q' => $q])) }}"
               class="inline-flex items-center rounded-full border px-4 py-2 text-xs font-semibold transition
                      {{ (string)$cat->id === $activeCategoryId ? 'border-white/20 bg-white/10 text-white' : 'border-white/10 bg-black/20 text-white/80 hover:bg-white/10' }}">
              {{ $cat->name }}
            </a>
          @endforeach
        </div>

        <div class="flex gap-2">
          <input name="q" value="{{ $q }}" placeholder="Rechercher..."
                 class="w-full sm:w-72 rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 placeholder:text-white/35 outline-none focus:ring-2 focus:ring-[var(--accent)]" />
          @if($activeCategoryId !== '')
            <input type="hidden" name="category" value="{{ $activeCategoryId }}">
          @endif
          <button class="rounded-2xl px-5 py-3 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
                  style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
            OK
          </button>
        </div>
      </form>

      @if($activeCategoryId !== '')
        <div class="text-sm text-white/70">
          Filtre actif :
          <span class="font-semibold text-white/90">
            {{ optional(($categories ?? collect())->firstWhere('id', (int)$activeCategoryId))->name ?? 'Catégorie' }}
          </span>
          <a href="{{ route('actualites.index', array_filter(['q' => $q])) }}"
             class="ml-2 text-white/80 underline hover:text-white">
            Réinitialiser
          </a>
        </div>
      @endif
    </div>
  </div>
</section>

{{-- LIST --}}
<section class="bg-dark text-white">
  <div class="max-w-7xl mx-auto px-6 pb-14">
    <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @forelse($actualites as $a)
        @php
          // cover priority: uploaded featured_image_path then featuredMedia if image
          $uploadedImage = !empty($a->featured_image_path)
              ? asset('storage/' . ltrim($a->featured_image_path, '/'))
              : null;

          $mediaImage = null;
          if (
              !$uploadedImage
              && !empty($a->featuredMedia)
              && (($a->media_type ?? null) === 'image')
          ) {
              $mediaImage = !empty($a->featuredMedia->file_path)
                  ? asset('storage/' . ltrim($a->featuredMedia->file_path, '/'))
                  : null;
          }

          $cover = $uploadedImage ?? $mediaImage;

          $dateLabel = $a->published_at
              ? $a->published_at->format('d M Y')
              : $a->created_at->format('d M Y');

          $cats = $a->categories ?? collect();
        @endphp

        <article class="group overflow-hidden rounded-2xl border border-white/10 bg-white/5 shadow-2xl backdrop-blur-md transition hover:-translate-y-0.5 hover:bg-white/[0.07]">
          <a href="{{ route('actualites.show', $a->slug) }}" class="block">
            <div class="relative h-48 w-full overflow-hidden bg-black/20">
              @if($cover)
                <img src="{{ $cover }}" alt="{{ $a->title }}"
                     class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.04]" loading="lazy">
              @else
                <div class="flex h-full w-full items-center justify-center text-sm text-white/50">
                  Visuel indisponible
                </div>
              @endif

              <div class="pointer-events-none absolute inset-0 opacity-80"
                   style="background: linear-gradient(180deg, rgba(0,0,0,0.0) 35%, rgba(0,0,0,0.65) 100%);"></div>

              {{-- Category badges --}}
              @if($cats->count())
                <div class="absolute left-4 top-4 right-4 flex flex-wrap gap-2">
                  @foreach($cats->take(2) as $c)
                  @if ($c->name === 'Urgent')
                    <span class="inline-flex items-center rounded-full border border-red-600 bg-red-600 px-3 py-1 text-xs font-semibold text-white">
                      {{ $c->name }}
                    </span> 
                  @else
                    <span class="inline-flex items-center rounded-full border border-white/10 bg-pink-600 px-3 py-1 text-xs font-semibold text-white/90">
                      {{ $c->name }}
                    </span>
                  @endif
                  @endforeach
                  @if($cats->count() > 2)
                    <span class="inline-flex items-center rounded-full border border-white/10 bg-black/40 px-3 py-1 text-xs font-semibold text-white/90">
                      +{{ $cats->count() - 2 }}
                    </span>
                  @endif
                </div>
              @endif
            </div>

            <div class="p-6">
              <div class="flex items-center justify-between gap-3">
                <h3 class="text-lg font-extrabold tracking-tight text-white line-clamp-2">
                  {{ $a->title }}
                </h3>
              </div>

              @if(!empty($a->chapo))
                <p class="mt-2 text-sm text-white/70 line-clamp-3">
                  {{ $a->chapo }}
                </p>
              @endif

              <div class="mt-5 flex items-center justify-between text-xs text-white/60">
                <span class="inline-flex items-center gap-2">
                  <span class="inline-flex h-2 w-2 rounded-full" style="background: var(--accent);"></span>
                  {{ $dateLabel }}
                </span>

                <span class="inline-flex items-center gap-2 font-semibold" style="color: var(--accent-2);">
                  Lire <span class="transition-transform group-hover:translate-x-0.5">→</span>
                </span>
              </div>
            </div>
          </a>
        </article>
      @empty
        <div class="rounded-3xl border border-white/10 bg-white/5 p-8 text-center text-white/70 sm:col-span-2 lg:col-span-3">
          Aucune actualité.
        </div>
      @endforelse
    </div>

    <div class="mt-10">
      {{ $actualites->appends(request()->query())->links() }}
    </div>
  </div>
</section>
@endsection
