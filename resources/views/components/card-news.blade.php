{{-- filepath: /c:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/components/card-news.blade.php --}}
@props(['news'])

@php
  $date = $news->published_at ? $news->published_at->format('d M Y') : $news->created_at->format('d M Y');
  $views = (int) ($news->views_count ?? 0);

  // Image source priority:
  // 1) Uploaded image stored on actualites.featured_image_path (public disk)
  $uploadedImage = !empty($news->featured_image_path)
      ? asset('storage/' . ltrim($news->featured_image_path, '/'))
      : null;

  // 2) MediaItem relation (existing behavior)
  $mediaImage = null;
  if (!$uploadedImage && $news->featuredMedia && ($news->media_type === 'image')) {
      // keep compatibility with your current column name on media_items
      $mediaImage = !empty($news->featuredMedia->file_path)
          ? asset('storage/' . ltrim($news->featuredMedia->file_path, '/'))
          : null;
  }

  $coverImage = $uploadedImage ?? $mediaImage;
@endphp

<article class="group relative overflow-hidden rounded-2xl border border-black/5 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-xl">
  <a href="{{ route('actualites.show', $news->slug) }}" class="block">
    {{-- Media --}}
    <div class="relative h-44 w-full overflow-hidden bg-gray-100 sm:h-52">
      @if($coverImage)
        <img
          src="{{ $coverImage }}"
          alt="{{ $news->title }}"
          class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.04]"
          loading="lazy"
        >
      @elseif($news->featuredMedia && $news->media_type === 'video')
        <div class="relative flex h-full w-full items-center justify-center bg-black text-white">
          <div class="absolute inset-0 opacity-70"
               style="background: radial-gradient(700px 260px at 50% 20%, rgba(255,255,255,0.18), transparent 60%);"></div>
          <div class="relative inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-sm font-semibold backdrop-blur">
            <span class="inline-flex h-2 w-2 rounded-full" style="background: var(--accent);"></span>
            Vidéo
          </div>
        </div>
      @else
        <div class="relative flex h-full w-full items-center justify-center text-gray-400">
          <div class="absolute inset-0 opacity-70"
               style="background: radial-gradient(700px 260px at 50% 20%, rgba(0,0,0,0.10), transparent 60%);"></div>
          <span class="relative text-sm">Image indisponible</span>
        </div>
      @endif

      {{-- Badge --}}
      <div class="absolute left-4 top-4 inline-flex items-center gap-2 rounded-full bg-white/90 px-3 py-1 text-xs font-semibold text-gray-800 shadow-sm ring-1 ring-black/5">
        <span class="inline-flex h-1.5 w-1.5 rounded-full" style="background: var(--accent-2);"></span>
        Actualité
      </div>
    </div>

    {{-- Body --}}
    <div class="p-5">
      <div class="flex items-center justify-between gap-3 text-xs text-gray-500">
        <span class="inline-flex items-center gap-2">
          <span class="inline-flex h-2 w-2 rounded-full" style="background: var(--accent);"></span>
          {{ $date }}
        </span>

        @if($news->status === 'published')
          <span class="inline-flex items-center gap-2">
            <span class="inline-flex h-2 w-2 rounded-full" style="background: var(--accent-2);"></span>
            Publié
          </span>
        @else
          <span class="inline-flex items-center gap-2">
            <span class="inline-flex h-2 w-2 rounded-full bg-gray-300"></span>
            Brouillon
          </span>
        @endif
      </div>

      <h3 class="mt-3 line-clamp-2 text-base font-extrabold tracking-tight text-gray-900">
        {{ $news->title }}
      </h3>

      @if($news->chapo)
        <p class="mt-2 line-clamp-3 text-sm text-gray-600">
          {{ $news->chapo }}
        </p>
      @else
        <p class="mt-2 line-clamp-3 text-sm text-gray-600">
          {{ Str::limit(strip_tags($news->content ?? ''), 120) }}
        </p>
      @endif

      <div class="mt-5 flex items-center justify-between text-xs text-gray-500">
        <span class="inline-flex items-center gap-2">
          <span class="inline-flex h-2 w-2 rounded-full" style="background: var(--accent-2);"></span>
          {{ number_format($views, 0, ',', ' ') }} vues
        </span>

        <span class="inline-flex items-center gap-2 font-semibold" style="color: var(--accent);">
          Lire <span class="transition-transform group-hover:translate-x-0.5">→</span>
        </span>
      </div>
    </div>
  </a>
</article>