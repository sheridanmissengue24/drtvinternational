
<h2 class="text-3xl font-extrabold mb-4">
    Nos Programmes
  </h2>
  
  @php
    // Attendu depuis le controller: $programmes (Collection)
    $items = $programmes ?? collect();
  
    $programmeCover = function ($p) {
        // 1) image uploadée (chemin storage) si ta table a cover_image_path
        if (!empty($p->cover_image_path)) {
            return asset('storage/' . ltrim($p->cover_image_path, '/'));
        }
  
        // 2) champ url direct si existant
        if (!empty($p->cover_url)) {
            return $p->cover_url;
        }
  
        // 3) fallback
        return 'https://lorempicture.point-sys.com/400/300/';
    };
  
    $programmeHref = function ($p) {
        // si tu as une route dédiée: programmes.show
        if (Route::has('programmes.show') && !empty($p->slug)) {
            return route('programmes.show', $p->slug);
        }
        return '#';
    };
  
    $programmeMeta = function ($p) {
        // adapte selon tes colonnes: frequency, periodicity, type, etc.
        return $p->frequency
            ?? $p->periodicity
            ?? $p->type
            ?? 'Programme';
    };
  @endphp
  
  @if($items->count())
    <div class="grid md:grid-cols-3 gap-10 mb-3">
      @foreach($items->take(3) as $programme)
        <a href="{{ route('programme.show',$programme->slug) }}"
           class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition block">
          <div class="relative h-48 w-full bg-gray-100">
            <img src="{{ $programmeCover($programme) }}"
                 alt="{{ $programme->title ?? $programme->name ?? 'Programme' }}"
                 class="h-48 w-full object-cover transition duration-500 group-hover:scale-[1.03]"
                 loading="lazy">
          </div>
  
          <div class="p-6">
            <h3 class="font-bold text-xl mb-2">
              {{ $programme->title ?? $programme->name ?? 'Programme' }}
            </h3>
  
            @if(!empty($programme->description))
              <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                {{ $programme->description }}
              </p>
            @else
              <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                Découvrez ce programme.
              </p>
            @endif
  
            <span class="text-sm font-semibold" style="color: var(--accent);">
              {{-- {{ $programmeMeta($programme) }} --}}
            </span>
          </div>
        </a>
      @endforeach
    </div>
  
    @if(Route::has('programme.index'))
      <div class="mt-2 mb-3">
        <a href="{{ route('programme.index') }}"
           class="inline-flex items-center justify-center rounded-full px-5 py-3 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
           style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
          Voir tous les programmes
        </a>
      </div>
    @endif
  @else
    <div class="bg-white rounded-2xl p-6 shadow-lg">
      <p class="text-gray-600 text-sm">Aucun programme disponible pour le moment.</p>
    </div>
  @endif
  