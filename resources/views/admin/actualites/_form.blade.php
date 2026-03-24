{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/actualites/_form.blade.php --}}
@php
  $isEdit = isset($actualite);

  $tagsValue = old('tags');
  if ($tagsValue === null) {
    $tags = $actualite->tags ?? null;
    $tagsValue = is_array($tags) ? implode(', ', $tags) : '';
  }

  $statusValue = old('status', $actualite->status ?? 'draft');

  // published_at value priority:
  // 1) old('published_at') (validation error)
  // 2) existing model value
  // 3) timestamp passed via query (?published_at=1710000000) or via old('published_at_ts')
  $publishedAtValue = old('published_at');

  if ($publishedAtValue === null && isset($actualite?->published_at) && $actualite->published_at) {
    $publishedAtValue = $actualite->published_at->format('Y-m-d\TH:i');
  }

  if ($publishedAtValue === null) {
    $ts = request()->query('published_at');

    if ($ts === null) {
      $ts = old('published_at_ts');
    }

    if ($ts !== null && is_numeric($ts)) {
      try {
        $publishedAtValue = \Carbon\Carbon::createFromTimestamp((int) $ts)->format('Y-m-d\TH:i');
      } catch (\Throwable $e) {
        $publishedAtValue = '';
      }
    }
  }

  $publishedAtValue = $publishedAtValue ?? '';

  $hasFeaturedImage = isset($actualite) && !empty($actualite->featured_image_path);

  // Categories select
  $selectedCategoryIds = collect(old('category_ids', isset($actualite) ? ($actualite->categories?->pluck('id')->all() ?? []) : []))
      ->map(fn ($v) => (string) $v)
      ->all();
@endphp

<div class="grid gap-5 lg:grid-cols-12">
  {{-- Main --}}
  <div class="lg:col-span-8 space-y-4">
    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-5">
      <div class="grid gap-2">
        <label class="text-xs font-semibold uppercase tracking-wider text-white/60">Titre</label>
        <input name="title" value="{{ old('title', $actualite->title ?? '') }}"
               class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 placeholder:text-white/35 outline-none focus:ring-2 focus:ring-[var(--accent)]"
               placeholder="Titre de l’actualité" />
        @error('title') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-4 grid gap-2">
        <label class="text-xs font-semibold uppercase tracking-wider text-white/60">Slug (optionnel)</label>
        <input name="slug" value="{{ old('slug', $actualite->slug ?? '') }}"
               class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 placeholder:text-white/35 outline-none focus:ring-2 focus:ring-[var(--accent)]"
               placeholder="auto-si-vide" />
        @error('slug') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-4 grid gap-2">
        <label class="text-xs font-semibold uppercase tracking-wider text-white/60">Chapo</label>
        <textarea name="chapo" rows="3"
                  class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 placeholder:text-white/35 outline-none focus:ring-2 focus:ring-[var(--accent)]"
                  placeholder="Accroche (optionnel)">{{ old('chapo', $actualite->chapo ?? '') }}</textarea>
        @error('chapo') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-4 grid gap-2">
        <label class="text-xs font-semibold uppercase tracking-wider text-white/60">Contenu</label>
        <textarea name="content" rows="14"
                  class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 placeholder:text-white/35 outline-none focus:ring-2 focus:ring-[var(--accent)]"
                  placeholder="Rédigez ici…">{{ old('content', $actualite->content ?? '') }}</textarea>
        @error('content') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>
    </div>

    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-5">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">SEO</div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">SEO title</label>
        <input name="seo_title" value="{{ old('seo_title', $actualite->seo_title ?? '') }}"
               class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]"
               placeholder="Optionnel" />
        @error('seo_title') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">SEO description</label>
        <textarea name="seo_description" rows="3"
                  class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]"
                  placeholder="Optionnel">{{ old('seo_description', $actualite->seo_description ?? '') }}</textarea>
        @error('seo_description') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>
    </div>

    {{-- Categories --}}
    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-5">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Catégories</div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Sélection</label>

        <select name="category_ids[]" multiple size="8"
                class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]">
          @foreach(($categories ?? collect()) as $cat)
            <option value="{{ $cat->id }}" @selected(in_array((string)$cat->id, $selectedCategoryIds, true))>
              {{ $cat->name }}
            </option>
          @endforeach
        </select>

        <div class="text-xs text-white/50">Maintiens Ctrl (Windows) pour sélectionner plusieurs catégories.</div>
        @error('category_ids') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
        @error('category_ids.*') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>
    </div>
  </div>

  {{-- Side --}}
  <div class="lg:col-span-4 space-y-4">
    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-5">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Publication</div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Statut</label>
        <select name="status"
                class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]">
          <option value="draft" @selected($statusValue==='draft')>Brouillon</option>
          <option value="published" @selected($statusValue==='published')>Publié</option>
        </select>
        @error('status') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Publié le</label>
        <input type="datetime-local" name="published_at" value="{{ $publishedAtValue }}"
               class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]" />
        @error('published_at') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Auteur</label>
        <select name="author_id"
                class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]">
          <option value="">(Moi)</option>
          @foreach(($authors ?? collect()) as $u)
            <option value="{{ $u->id }}" @selected((string)old('author_id', $actualite->author_id ?? '') === (string)$u->id)>
              {{ $u->name }}
            </option>
          @endforeach
        </select>
        @error('author_id') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-3 text-xs text-white/50">
        Vues: <span class="text-white/80 font-semibold">{{ isset($actualite) ? number_format((int)$actualite->views_count) : '0' }}</span>
      </div>
    </div>

    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-5">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Image mise en avant</div>

      @if($hasFeaturedImage)
        <div class="mt-3 overflow-hidden rounded-2xl ring-1 ring-white/10 bg-black/25">
          <img src="{{ asset('storage/' . ltrim($actualite->featured_image_path, '/')) }}"
               alt="Image mise en avant"
               class="h-40 w-full object-cover" />
        </div>

        <label class="mt-3 inline-flex items-center gap-2 text-sm text-white/75">
          <input type="checkbox" name="remove_featured_image" value="1"
                 class="h-4 w-4 rounded border-white/20 bg-black/25" />
          Retirer l’image
        </label>
      @endif

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Uploader une image (JPG/PNG/WebP)</label>
        <input type="file" name="featured_image" accept="image/*"
               class="block w-full text-sm text-white/75
                      file:mr-4 file:rounded-2xl file:border-0
                      file:bg-white/10 file:px-4 file:py-2.5
                      file:text-sm file:font-semibold file:text-white
                      hover:file:bg-white/14 transition" />
        @error('featured_image') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-2 text-xs text-white/50">
        Stockage: <span class="text-white/70 font-semibold">public</span> (storage/app/public) via
        <code class="text-white/70">php artisan storage:link</code>.
      </div>
    </div>

    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-5">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Média (optionnel)</div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Type</label>
        <select name="media_type"
                class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]">
          <option value="" @selected(old('media_type', $actualite->media_type ?? '')==='')>Aucun</option>
          <option value="image" @selected(old('media_type', $actualite->media_type ?? '')==='image')>Image</option>
          <option value="video" @selected(old('media_type', $actualite->media_type ?? '')==='video')>Vidéo</option>
        </select>
        @error('media_type') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Media item (featured)</label>
        <select name="featured_media_id"
                class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]">
          <option value="">—</option>
          @foreach(($mediaItems ?? collect()) as $m)
            <option value="{{ $m->id }}" @selected((string)old('featured_media_id', $actualite->featured_media_id ?? '') === (string)$m->id)>
              #{{ $m->id }} {{ $m->title ?? $m->name ?? 'Media' }}
            </option>
          @endforeach
        </select>
        @error('featured_media_id') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>
    </div>

    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-5">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Tags</div>
      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Liste (séparée par virgules)</label>
        <input name="tags" value="{{ $tagsValue }}"
               class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]"
               placeholder="politique, sport, culture" />
        @error('tags') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>
    </div>

    <div class="flex items-center justify-end gap-2">
      <a href="{{ route('admin.actualites.index') }}"
         class="rounded-2xl bg-white/8 ring-1 ring-white/10 px-4 py-2.5 text-sm font-semibold text-white/85 hover:bg-white/12 transition">
        Annuler
      </a>
      <button class="rounded-2xl px-4 py-2.5 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
              style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
        {{ $isEdit ? 'Enregistrer' : 'Créer' }}
      </button>
    </div>
  </div>
</div>