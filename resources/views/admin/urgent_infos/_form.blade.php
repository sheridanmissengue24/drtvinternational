{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/urgent_infos/_form.blade.php --}}
@php
  $isEdit = isset($urgent);

  $levelValue = old('level', $urgent->level ?? 'info');

  // store active as "1"/"0" to match <select>
  $activeValue = old('active', isset($urgent) ? ($urgent->active ? '1' : '0') : '1');

  // datetime-local expects: YYYY-MM-DDTHH:MM
  $startsAtValue = old('starts_at');
  if ($startsAtValue === null && !empty($urgent?->starts_at)) {
      $startsAtValue = $urgent->starts_at->format('Y-m-d\TH:i');
  }
  $startsAtValue = $startsAtValue ?? '';

  $endsAtValue = old('ends_at');
  if ($endsAtValue === null && !empty($urgent?->ends_at)) {
      $endsAtValue = $urgent->ends_at->format('Y-m-d\TH:i');
  }
  $endsAtValue = $endsAtValue ?? '';
@endphp

<div class="grid gap-5 lg:grid-cols-12">
  <div class="lg:col-span-8 space-y-4">
    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-5">
      <div class="grid gap-2">
        <label class="text-xs font-semibold uppercase tracking-wider text-white/60">Titre</label>
        <input name="title" value="{{ old('title', $urgent->title ?? '') }}"
               class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]"
               placeholder="Titre court" />
        @error('title') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-4 grid gap-2">
        <label class="text-xs font-semibold uppercase tracking-wider text-white/60">Message</label>
        <textarea name="message" rows="8"
                  class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]"
                  placeholder="Texte de l’info urgente">{{ old('message', $urgent->message ?? '') }}</textarea>
        @error('message') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>
    </div>
  </div>

  <div class="lg:col-span-4 space-y-4">
    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-5">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Paramètres</div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Niveau</label>
        <select name="level"
                class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]">
          @foreach(($levels ?? ['info','warning','danger']) as $lv)
            <option value="{{ $lv }}" @selected($levelValue === $lv)>{{ strtoupper($lv) }}</option>
          @endforeach
        </select>
        @error('level') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Actif</label>
        <select name="active"
                class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]">
          <option value="1" @selected((string) $activeValue === '1')>Oui</option>
          <option value="0" @selected((string) $activeValue === '0')>Non</option>
        </select>
        @error('active') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Début (date &amp; heure)</label>
        <input type="datetime-local" name="starts_at" value="{{ $startsAtValue }}" step="60"
               class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]" />
        @error('starts_at') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Fin (date &amp; heure)</label>
        <input type="datetime-local" name="ends_at" value="{{ $endsAtValue }}" step="60"
               class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]" />
        @error('ends_at') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-3 text-xs text-white/55">
      </div>
    </div>

    <div class="flex items-center justify-end gap-2">
      <a href="{{ route('admin.urgent.index') }}"
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