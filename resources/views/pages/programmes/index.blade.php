{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/pages/programmes/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Programmes')

@section('content')
<section class="relative overflow-hidden bg-dark text-white">
  <div class="pointer-events-none absolute inset-0">
    <div class="absolute -top-24 -left-24 h-80 w-80 rounded-full blur-3xl opacity-30"
         style="background: radial-gradient(circle, var(--accent), transparent 60%);"></div>
    <div class="absolute -bottom-28 -right-28 h-96 w-96 rounded-full blur-3xl opacity-25"
         style="background: radial-gradient(circle, var(--accent-2), transparent 60%);"></div>

    <div class="absolute inset-0 opacity-[0.06]"
         style="background-image: linear-gradient(to right, #fff 1px, transparent 1px),
                                linear-gradient(to bottom, #fff 1px, transparent 1px);
                background-size: 32px 32px;"></div>

    <div class="absolute inset-0"
         style="background: radial-gradient(900px 360px at 50% 18%, rgba(255,255,255,0.10), transparent 62%);"></div>
  </div>

  <div class="relative max-w-7xl mx-auto px-6 py-14 md:py-18">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
      <div>
        <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-semibold text-white/90 backdrop-blur">
          <span class="inline-flex h-2 w-2 rounded-full"
                style="background: var(--accent); box-shadow: 0 0 18px var(--accent);"></span>
          Programmes
        </div>
        <h1 class="mt-4 text-3xl font-extrabold tracking-tight text-white sm:text-5xl">
          Nos programmes
        </h1>
        <p class="mt-2 max-w-2xl text-sm text-white/70 sm:text-base">
          Retrouvez la liste des programmes et découvrez nos contenus.
        </p>
      </div>

      <form method="GET" class="w-full sm:w-auto">
        <div class="flex gap-2">
          <input name="q" value="{{ request('q') }}" placeholder="Rechercher un programme..."
                 class="w-full sm:w-72 rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 placeholder:text-white/35 outline-none focus:ring-2 focus:ring-[var(--accent)]" />
          <button class="rounded-2xl px-5 py-3 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
                  style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
            OK
          </button>
        </div>
      </form>
    </div>
  </div>
</section>

<section class="bg-dark text-white">
  <div class="max-w-7xl mx-auto px-6 pb-14">
    <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      @forelse($programmes as $programme)
        @php
          // Image priority: local upload -> cover_url -> none
          $cover = null;
          if (!empty($programme->cover_image_path)) {
              $cover = asset('storage/' . ltrim($programme->cover_image_path, '/'));
          } elseif (!empty($programme->cover_url)) {
              $cover = $programme->cover_url;
          }
        @endphp

        <article class="group overflow-hidden rounded-2xl border border-white/10 bg-white/5 shadow-2xl backdrop-blur-md transition hover:-translate-y-0.5 hover:bg-white/[0.07]">
          <a href="{{ route('programme.show', $programme) }}" class="block">
            <div class="relative h-48 w-full overflow-hidden bg-black/20">
              @if($cover)
                <img src="{{ $cover }}" alt="{{ $programme->title }}"
                     class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.04]" loading="lazy">
              @else
                <div class="flex h-full w-full items-center justify-center text-sm text-white/50">
                  Visuel indisponible
                </div>
              @endif

              <div class="pointer-events-none absolute inset-0 opacity-80"
                   style="background: linear-gradient(180deg, rgba(0,0,0,0.0) 35%, rgba(0,0,0,0.65) 100%);"></div>

              @if($programme->is_featured)
                <div class="absolute left-4 top-4 inline-flex items-center rounded-full border border-white/10 bg-black/40 px-3 py-1 text-xs font-semibold text-white/90">
                  À la une
                </div>
              @endif
            </div>

            <div class="p-6">
              <div class="flex items-center justify-between gap-3">
                <h3 class="text-lg font-extrabold tracking-tight text-white line-clamp-2">
                  {{ $programme->title }}
                </h3>
              </div>

              @if(!empty($programme->description))
                <p class="mt-2 text-sm text-white/70 line-clamp-3">
                  {{ $programme->description }}
                </p>
              @else
                <p class="mt-2 text-sm text-white/70 line-clamp-3">
                  Découvrez ce programme.
                </p>
              @endif

              <div class="mt-5 flex items-center justify-between text-xs text-white/60">
                <span class="inline-flex items-center gap-2">
                  <span class="inline-flex h-2 w-2 rounded-full" style="background: var(--accent);"></span>
                  {{ $programme->updated_at?->format('d M Y') ?? $programme->created_at?->format('d M Y') }}
                </span>

                <span class="inline-flex items-center gap-2 font-semibold" style="color: var(--accent-2);">
                  Voir <span class="transition-transform group-hover:translate-x-0.5">→</span>
                </span>
              </div>
            </div>
          </a>
        </article>
      @empty
        <div class="rounded-3xl border border-white/10 bg-white/5 p-8 text-center text-white/70 sm:col-span-2 lg:col-span-3">
          Aucun programme disponible pour le moment.
        </div>
      @endforelse
    </div>

    @if(method_exists($programmes, 'links'))
      <div class="mt-10">
        {{ $programmes->links() }}
      </div>
    @endif
  </div>
</section>
@endsection