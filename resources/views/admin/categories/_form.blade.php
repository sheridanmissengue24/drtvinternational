{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/categories/_form.blade.php --}}
@php
  $isEdit = isset($category);
@endphp

<div class="space-y-5">
  <div class="grid gap-2">
    <label class="text-xs font-semibold uppercase tracking-wider text-white/60">Nom</label>
    <input name="name" value="{{ old('name', $category->name ?? '') }}"
           class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]"
           placeholder="Ex: Politique, Sport..." />
    @error('name') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
  </div>

  <div class="grid gap-2">
    <label class="text-xs font-semibold uppercase tracking-wider text-white/60">Slug (optionnel)</label>
    <input name="slug" value="{{ old('slug', $category->slug ?? '') }}"
           class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]"
           placeholder="auto-si-vide" />
    @error('slug') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
  </div>

  <div class="flex items-center justify-end gap-2">
    <a href="{{ route('admin.categories.index') }}"
       class="rounded-2xl bg-white/8 ring-1 ring-white/10 px-4 py-2.5 text-sm font-semibold text-white/85 hover:bg-white/12 transition">
      Annuler
    </a>
    <button class="rounded-2xl px-4 py-2.5 text-sm font-semibold text-white"
            style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
      {{ $isEdit ? 'Enregistrer' : 'Créer' }}
    </button>
  </div>
</div>