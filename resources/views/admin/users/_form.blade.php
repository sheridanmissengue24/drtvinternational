{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/users/_form.blade.php --}}
@php
  $isEdit = isset($user);
  $roleValue = old('role', $user->role ?? 'user');
@endphp

<div class="grid gap-5 lg:grid-cols-12">
  <div class="lg:col-span-8 space-y-4">
    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-5">
      <div class="grid gap-2">
        <label class="text-xs font-semibold uppercase tracking-wider text-white/60">Nom</label>
        <input name="name" value="{{ old('name', $user->name ?? '') }}"
               class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]"
               placeholder="Nom complet" />
        @error('name') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-4 grid gap-2">
        <label class="text-xs font-semibold uppercase tracking-wider text-white/60">Email</label>
        <input name="email" type="email" value="{{ old('email', $user->email ?? '') }}"
               class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]"
               placeholder="email@domaine.com" />
        @error('email') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>
    </div>
  </div>

  <div class="lg:col-span-4 space-y-4">
    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-5">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Sécurité</div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Rôle</label>
        <select name="role"
                class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]">
          @foreach(($roles ?? ['user','admin']) as $r)
            <option value="{{ $r }}" @selected((string)$roleValue === (string)$r)>{{ strtoupper($r) }}</option>
          @endforeach
        </select>
        @error('role') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">
          Mot de passe {{ $isEdit ? '(laisser vide pour ne pas changer)' : '' }}
        </label>
        <input name="password" type="password"
               class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]"
               placeholder="{{ $isEdit ? 'Nouveau mot de passe' : 'Mot de passe' }}" />
        @error('password') <div class="text-xs text-red-300">{{ $message }}</div> @enderror
      </div>

      <div class="mt-3 grid gap-2">
        <label class="text-xs font-semibold text-white/70">Confirmation mot de passe</label>
        <input name="password_confirmation" type="password"
               class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-3 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]"
               placeholder="Confirmer le mot de passe" />
      </div>
    </div>

    <div class="flex items-center justify-end gap-2">
      <a href="{{ route('admin.users.index') }}"
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