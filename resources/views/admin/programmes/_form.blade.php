{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/programmes/_form.blade.php --}}
@php
  $isEdit = isset($programme);
  $hasCover = $isEdit && !empty($programme->cover_image_path);
@endphp

<div class="grid gap-5 lg:grid-cols-12">
  <div class="lg:col-span-8 space-y-4">
    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-5">
      <div class="grid gap-2">
        <label class="text-xs font-semibold uppercase tracking-wider text-white/60">Titre</label>
        <input name="title" value="{{ old('title', $programme->title ?? '') }}"
               class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none" />
        @error('title') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-4 grid gap-2">
        <label class="text-xs font-semibold uppercase tracking-wider text-white/60">Slug (optionnel)</label>
        <input name="slug" value="{{ old('slug', $programme->slug ?? '') }}"
               class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none" />
        @error('slug') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-4 grid gap-2">
        <label class="text-xs font-semibold uppercase tracking-wider text-white/60">Description</label>
        <textarea name="description" rows="10"
                  class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none">{{ old('description', $programme->description ?? '') }}</textarea>
        @error('description') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>
    </div>
  </div>

  <div class="lg:col-span-4 space-y-4">
    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-5">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Cover</div>

      @if($hasCover)
        <div class="mt-3 overflow-hidden rounded-2xl ring-1 ring-white/10 bg-black/25">
          <img src="{{ asset('storage/' . ltrim($programme->cover_image_path, '/')) }}"
               alt="Cover"
               class="h-40 w-full object-cover" />
        </div>

        <label class="mt-3 inline-flex items-center gap-2 text-sm text-white/75">
          <input type="checkbox" name="remove_cover_image" value="1"
                 class="h-4 w-4 rounded border-white/20 bg-black/25" />
          Retirer l’image
        </label>
      @endif

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Uploader une image</label>
        <input type="file" name="cover_image" accept="image/*"
               class="block w-full text-sm text-white/75
                      file:mr-4 file:rounded-2xl file:border-0
                      file:bg-white/10 file:px-4 file:py-2.5
                      file:text-sm file:font-semibold file:text-white
                      hover:file:bg-white/14 transition" />
        @error('cover_image') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>
    </div>

    <div class="flex items-center justify-end gap-2">
      <a href="{{ route('admin.programmes.index') }}"
         class="rounded-2xl bg-white/8 ring-1 ring-white/10 px-4 py-2.5 text-sm font-semibold text-white/85 hover:bg-white/12 transition">
        Annuler
      </a>
      <button class="rounded-2xl px-4 py-2.5 text-sm font-semibold text-white"
              style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
        {{ $isEdit ? 'Enregistrer' : 'Créer' }}
      </button>
    </div>
  </div>
</div>