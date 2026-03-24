{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/users/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Utilisateurs')
@section('header', 'Utilisateurs')

@section('content')
  <div class="space-y-5">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
      <form method="GET" class="w-full">
        <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-4">
          <input name="q" value="{{ $q ?? '' }}" placeholder="Rechercher (nom/email)..."
                 class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-2.5 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]" />

          <select name="role"
                  class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-2.5 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]">
            <option value="">Tous rôles</option>
            @foreach($roles as $r)
              <option value="{{ $r }}" @selected((string)$role === (string)$r)>{{ strtoupper($r) }}</option>
            @endforeach
          </select>

          <div class="flex gap-2 lg:col-span-2">
            <button class="w-full rounded-2xl bg-white/10 px-4 py-2.5 text-sm font-semibold text-white/90 hover:bg-white/14 transition">
              OK
            </button>
            <a href="{{ route('admin.users.index') }}"
               class="w-full text-center rounded-2xl bg-white/6 ring-1 ring-white/10 px-4 py-2.5 text-sm font-semibold text-white/80 hover:bg-white/10 transition">
              Reset
            </a>
          </div>
        </div>
      </form>

      <a href="{{ route('admin.users.create') }}"
         class="w-full sm:w-auto text-center rounded-2xl px-4 py-2.5 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
         style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
        Nouvel utilisateur
      </a>
    </div>

    <div class="overflow-x-auto rounded-3xl ring-1 ring-white/10 bg-white/6">
      <table class="min-w-full text-sm">
        <thead class="text-white/70">
          <tr class="border-b border-white/10">
            <th class="px-4 py-3 text-left font-semibold">Nom</th>
            <th class="px-4 py-3 text-left font-semibold">Email</th>
            <th class="px-4 py-3 text-left font-semibold">Rôle</th>
            <th class="px-4 py-3 text-left font-semibold">Créé</th>
            <th class="px-4 py-3 text-right font-semibold">Actions</th>
          </tr>
        </thead>
        <tbody class="text-white/85">
          @forelse($users as $u)
            <tr class="border-b border-white/10">
              <td class="px-4 py-3 font-semibold">{{ $u->name }}</td>
              <td class="px-4 py-3 text-white/75">{{ $u->email }}</td>
              <td class="px-4 py-3">
                <span class="inline-flex items-center rounded-full border border-white/10 px-3 py-1 text-xs font-semibold
                             {{ $u->role === 'admin' ? 'bg-white/10 text-white' : 'bg-black/25 text-white/80' }}">
                  {{ strtoupper($u->role) }}
                </span>
              </td>
              <td class="px-4 py-3 text-white/60">{{ $u->created_at?->format('d M Y') ?? '—' }}</td>
              <td class="px-4 py-3 text-right">
                <div class="inline-flex items-center gap-2">
                  <a href="{{ route('admin.users.edit', $u) }}"
                     class="rounded-2xl bg-white/10 px-3 py-2 text-sm font-semibold text-white/90 hover:bg-white/14 transition">
                    Modifier
                  </a>
                  <form method="POST" action="{{ route('admin.users.destroy', $u) }}"
                        onsubmit="return confirm('Supprimer cet utilisateur ?')">
                    @csrf
                    @method('DELETE')
                    <button class="rounded-2xl bg-red-500/20 px-3 py-2 text-sm font-semibold text-red-100 hover:bg-red-500/30 transition">
                      Supprimer
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-4 py-10 text-center text-white/70">Aucun utilisateur.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="overflow-x-auto">{{ $users->links() }}</div>
  </div>
@endsection