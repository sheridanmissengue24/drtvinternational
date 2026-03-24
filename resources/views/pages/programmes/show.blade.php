{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/pages/programmes/show.blade.php --}}
@extends('layouts.app')

@section('title', ($programme->title ?? 'Programme') . ' | Programmes')

@section('content')
@php
  // Image priority: local upload -> cover_url -> none
  $cover = null;
  if (!empty($programme->cover_image_path)) {
      $cover = asset('storage/' . ltrim($programme->cover_image_path, '/'));
  } elseif (!empty($programme->cover_url)) {
      $cover = $programme->cover_url;
  }

  $dateLabel = ($programme->updated_at ?? $programme->created_at)
      ? ($programme->updated_at ?? $programme->created_at)->format('d M Y')
      : null;

  $badgeLabel = !empty($programme->is_featured) ? 'À la une' : 'Programme';
@endphp

{{-- HERO --}}
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

  <div class="relative max-w-6xl mx-auto px-6 py-10 md:py-14">
    <div class="mb-6 flex items-center justify-between gap-3">
      <a href="{{ route('programme.index') }}"
         class="inline-flex items-center justify-center rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-semibold text-white/90 hover:bg-white/10 transition">
        ← Tous les programmes
      </a>

      <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-black/25 px-4 py-2 text-xs font-semibold text-white/80">
        <span class="inline-flex h-2 w-2 rounded-full" style="background: var(--accent-2);"></span>
        {{ $badgeLabel }}
      </span>
    </div>

    <div class="overflow-hidden rounded-3xl border border-white/10 bg-white/5 shadow-2xl backdrop-blur-md">
      <div class="relative h-56 w-full bg-black/20 sm:h-72 md:h-80">
        @if($cover)
          <img
            src="{{ $cover }}"
            alt="{{ $programme->title }}"
            class="absolute inset-0 h-full w-full object-cover"
            loading="lazy"
          />
        @else
          <div class="absolute inset-0 flex items-center justify-center text-sm text-white/50">
            Visuel indisponible
          </div>
        @endif

        <div class="pointer-events-none absolute inset-0 opacity-85"
             style="background: linear-gradient(180deg, rgba(0,0,0,0.10) 0%, rgba(0,0,0,0.78) 100%);"></div>

        <div class="absolute left-6 right-6 bottom-5">
          <div class="flex items-end justify-between gap-4">
            <div class="min-w-0">
              <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight text-white">
                {{ $programme->title }}
              </h1>

              @if(!empty($programme->subtitle))
                <p class="mt-2 text-sm text-white/75 line-clamp-2">
                  {{ $programme->subtitle }}
                </p>
              @endif
            </div>

            @if(!empty($programme->is_featured))
              <span class="shrink-0 inline-flex items-center rounded-full border border-white/10 bg-black/40 px-3 py-2 text-xs font-semibold text-white/90">
                À la une
              </span>
            @endif
          </div>
        </div>
      </div>

      <div class="flex flex-wrap items-center justify-between gap-3 px-6 py-4">
        <div class="inline-flex items-center gap-2 text-xs text-white/70">
          <span class="inline-flex h-2 w-2 rounded-full" style="background: var(--accent);"></span>
          @if($dateLabel)
            Mis à jour le {{ $dateLabel }}
          @else
            Dernière mise à jour indisponible
          @endif
        </div>

        <div class="flex items-center gap-2">
          <a href="{{ route('programme.index') }}"
             class="inline-flex items-center justify-center rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-semibold text-white/90 hover:bg-white/10 transition">
            Explorer
          </a>
        </div>
      </div>

      {{-- Body --}}
      <div class="p-6 md:p-10">
        <div class="grid gap-6 lg:grid-cols-12">
          {{-- Main --}}
          <div class="lg:col-span-8">
            <div class="rounded-2xl border border-white/10 bg-black/25 p-6">
              <div class="flex items-center justify-between gap-4">
                <h2 class="text-lg font-extrabold tracking-tight">Description</h2>
                <span class="hidden sm:inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-2 text-xs text-white/70">
                  <span class="inline-flex h-2 w-2 rounded-full" style="background: var(--accent-2);"></span>
                  {{ $badgeLabel }}
                </span>
              </div>

              @if($programme->description)
                <div class="prose prose-invert mt-4 max-w-none prose-p:text-white/80 prose-headings:text-white prose-strong:text-white">
                  {!! nl2br(e($programme->description)) !!}
                </div>
              @else
                <p class="mt-4 text-sm text-white/70">
                  Description indisponible pour le moment.
                </p>
              @endif
            </div>

            {{-- Extra block (optional look) --}}
            <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur">
              <h3 class="text-sm font-semibold text-white/90">Astuce</h3>
              <p class="mt-2 text-sm text-white/70">
                Retrouvez tous les programmes et repérez facilement ceux “À la une” pour ne rien rater.
              </p>
              <a href="{{ route('programme.index') }}"
                 class="mt-4 inline-flex items-center gap-2 text-sm font-semibold"
                 style="color: var(--accent);">
                Voir la liste <span class="transition-transform group-hover:translate-x-0.5">→</span>
              </a>
            </div>
          </div>

          {{-- Side --}}
          <aside class="lg:col-span-4 space-y-4">
            <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur">
              <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Infos</div>

              <dl class="mt-4 space-y-3 text-sm">
                {{-- <div class="flex items-center justify-between gap-4">
                  <dt class="text-white/60">Statut</dt>
                  <dd class="font-semibold text-white/90">
                    {{ ($programme->status ?? 'draft') === 'published' ? 'Publié' : 'Brouillon' }}
                  </dd>
                </div> --}}

                <div class="flex items-center justify-between gap-4">
                  <dt class="text-white/60">Créé le</dt>
                  <dd class="font-semibold text-white/90">
                    {{ $programme->created_at?->format('d M Y') ?? '—' }}
                  </dd>
                </div>

                {{-- <div class="flex items-center justify-between gap-4">
                  <dt class="text-white/60">Mis à jour</dt>
                  <dd class="font-semibold text-white/90">
                    {{ $programme->updated_at?->format('d M Y') ?? '—' }}
                  </dd>
                </div> --}}

                <div class="flex items-center justify-between gap-4">
                  <dt class="text-white/60">Type</dt>
                  <dd class="font-semibold text-white/90">
                    {{ $badgeLabel }}
                  </dd>
                </div>
              </dl>
            </div>

            @if(!empty($programme->cover_image_path) || !empty($programme->cover_url))
              <div class="rounded-2xl border border-white/10 bg-black/25 p-6">
                <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Visuel</div>
                <div class="mt-4 overflow-hidden rounded-2xl ring-1 ring-white/10 bg-black/20">
                  @if($cover)
                    <img src="{{ $cover }}" alt="{{ $programme->title }}" class="h-44 w-full object-cover" loading="lazy" />
                  @endif
                </div>
                <div class="mt-3 text-xs text-white/60">
                  {{-- Stocké en local via <code class="text-white/75">storage/app/public</code>. --}}
                </div>
              </div>
            @endif
          </aside>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection