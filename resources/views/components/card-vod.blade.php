@props(['video'])

<article class="group bg-white rounded-xl overflow-hidden border border-gray-200 hover:shadow-xl transition">

  <div class="relative aspect-video overflow-hidden">
    <img
      src="{{ asset($video->poster_path ?? 'images/placeholder-video.jpg') }}"
      alt="{{ $video->title }}"
      class="w-full h-full object-cover group-hover:scale-105 transition"
    >

    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
      <span class="bg-white/90 text-black px-6 py-2 rounded-full font-semibold">
        ▶ Regarder
      </span>
    </div>
  </div>

  <div class="p-5">
    <h3 class="font-bold text-lg leading-tight mb-2 line-clamp-2">
      {{ $video->title }}
    </h3>

    <p class="text-sm text-gray-600 line-clamp-2 mb-3">
      {{ $video->description }}
    </p>

    <div class="flex justify-between items-center text-xs text-gray-500">
      <span>{{ optional($video->published_at)->format('d M Y') }}</span>
      <a href="{{ route('vod.show', $video->id) }}"
         class="font-semibold text-red-600 hover:underline">
        Voir →
      </a>
    </div>
  </div>

</article>
