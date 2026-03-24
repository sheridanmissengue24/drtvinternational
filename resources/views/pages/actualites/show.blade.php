{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/pages/actualites/show.blade.php --}}
@extends('layouts.app')

@section('title', $actualite->seo_title ?? $actualite->title)

@section('content')
@php
  // Cover image priority:
  $uploadedImage = !empty($actualite->featured_image_path)
      ? asset('storage/' . ltrim($actualite->featured_image_path, '/'))
      : null;

  $mediaImage = null;
  if (
      !$uploadedImage
      && !empty($actualite->featuredMedia)
      && (($actualite->media_type ?? null) === 'image')
  ) {
      $mediaImage = !empty($actualite->featuredMedia->file_path)
          ? asset('storage/' . ltrim($actualite->featuredMedia->file_path, '/'))
          : null;
  }

  $coverImage = $uploadedImage ?? $mediaImage;

  $dateLabel = $actualite->published_at
      ? $actualite->published_at->format('d M Y')
      : $actualite->created_at->format('d M Y');

  $views = (int) ($actualite->views_count ?? 0);
  $authorName = $actualite->author?->name ?? null;
  $statusLabel = ($actualite->status ?? 'draft') === 'published' ? 'Publié' : 'Brouillon';
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

  <div class="relative max-w-6xl mx-auto px-6 pt-12 pb-10 md:pt-16 md:pb-14">
    <div class="flex flex-col gap-4">
      <div class="flex flex-wrap items-center gap-2">
        <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-2 text-xs font-semibold text-white/90 backdrop-blur">
          <span class="inline-flex h-2 w-2 rounded-full"
                style="background: var(--accent); box-shadow: 0 0 18px var(--accent);"></span>
          ACTUALITÉ
        </span>

        <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-black/25 px-4 py-2 text-xs font-semibold text-white/85">
          <span class="inline-flex h-2 w-2 rounded-full" style="background: var(--accent-2);"></span>
          {{ $statusLabel }}
        </span>

        <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-black/25 px-4 py-2 text-xs font-semibold text-white/80">
          <span class="inline-flex h-2 w-2 rounded-full bg-white/40"></span>
          {{ $dateLabel }}
        </span>

        @if($views > 0)
          <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-black/25 px-4 py-2 text-xs font-semibold text-white/80">
            <span class="inline-flex h-2 w-2 rounded-full bg-white/40"></span>
            {{ number_format($views, 0, ',', ' ') }} vues
          </span>
        @endif
      </div>

      <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-white">
        {{ $actualite->title }}
      </h1>

      @if($actualite->chapo)
        <p class="max-w-3xl text-white/75 text-base md:text-lg">
          {{ $actualite->chapo }}
        </p>
      @endif
    </div>
  </div>

  {{-- Cover full width (nice overlap) --}}
  @if($coverImage)
    <div class="relative max-w-6xl mx-auto px-6 pb-10">
      <div class="overflow-hidden rounded-3xl ring-1 ring-white/10 bg-black/20 shadow-2xl">
        <div class="relative aspect-[16/9] md:aspect-[21/9]">
          <img
            src="{{ $coverImage }}"
            alt="{{ $actualite->title }}"
            class="absolute inset-0 h-full w-full object-cover"
            loading="lazy"
          />
          <div class="pointer-events-none absolute inset-0"
               style="background: linear-gradient(180deg, rgba(0,0,0,0.00) 58%, rgba(0,0,0,0.35) 100%);"></div>
        </div>
      </div>
    </div>
  @endif
</section>

{{-- PAGE --}}
<section class="bg-neutral-50">
  <div class="max-w-6xl mx-auto px-6 py-10 md:py-14">
    <div class="grid gap-8 lg:grid-cols-12">
      {{-- Content card --}}
      <div class="lg:col-span-8">
          <div class="rounded-3xl bg-white ring-1 ring-black/5 shadow-sm overflow-hidden">
            <div class="p-6 md:p-8">
              <div
                class="prose prose-lg max-w-none prose-headings:scroll-mt-24 break-words text-justify"
                style="overflow-wrap:anywhere; word-break:break-word; text-align:justify; text-justify:inter-word;"
              >
                {!! nl2br(e($actualite->content)) !!}
              </div>

              <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <a href="{{ route('actualites.index') }}"
                  class="inline-flex items-center justify-center rounded-full border border-black/10 bg-white px-5 py-3 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-50 transition">
                  ← Retour aux actualités
                </a>

                <a href="#top"
                  class="inline-flex items-center justify-center rounded-full bg-gray-900 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-black transition">
                  Haut de page ↑
                </a>
              </div>
            </div>
          </div>
      </div>

      {{-- Sidebar meta --}}
      <aside class="lg:col-span-4 space-y-4">
        <div class="rounded-3xl bg-white ring-1 ring-black/5 shadow-sm">
          <div class="p-6">
            <div class="text-xs font-semibold uppercase tracking-wider text-gray-500">Infos</div>

            <dl class="mt-4 space-y-3 text-sm">
              @if($authorName)
                <div class="flex items-center justify-between gap-4">
                  <dt class="text-gray-500">Auteur</dt>
                  <dd class="font-semibold text-gray-900">{{ $authorName }}</dd>
                </div>
              @endif

              <div class="flex items-center justify-between gap-4">
                <dt class="text-gray-500">Date</dt>
                <dd class="font-semibold text-gray-900">{{ $dateLabel }}</dd>
              </div>

              <div class="flex items-center justify-between gap-4">
                <dt class="text-gray-500">Statut</dt>
                <dd class="font-semibold text-gray-900">{{ $statusLabel }}</dd>
              </div>

              <div class="flex items-center justify-between gap-4">
                <dt class="text-gray-500">Vues</dt>
                <dd class="font-semibold text-gray-900">{{ number_format($views, 0, ',', ' ') }}</dd>
              </div>
            </dl>
          </div>
        </div>

        @if($actualite->tags && is_array($actualite->tags) && count($actualite->tags))
          <div class="rounded-3xl bg-white ring-1 ring-black/5 shadow-sm">
            <div class="p-6">
              <div class="text-xs font-semibold uppercase tracking-wider text-gray-500">Tags</div>
              <div class="mt-4 flex flex-wrap gap-2">
                @foreach($actualite->tags as $tag)
                  <span class="inline-flex items-center rounded-full border border-black/10 bg-gray-50 px-3 py-1 text-xs font-semibold text-gray-700">
                    {{ $tag }}
                  </span>
                @endforeach
              </div>
            </div>
          </div>
        @endif

        @if(!empty($actualite->seo_description))
          <div class="rounded-3xl bg-white ring-1 ring-black/5 shadow-sm">
            <div class="p-6">
              <div class="text-xs font-semibold uppercase tracking-wider text-gray-500">Résumé</div>
              <p class="mt-4 text-sm text-gray-700 leading-relaxed">
                {{ $actualite->seo_description }}
              </p>
            </div>
          </div>
        @endif
      </aside>
    </div>
  </div>
</section>
@endsection
