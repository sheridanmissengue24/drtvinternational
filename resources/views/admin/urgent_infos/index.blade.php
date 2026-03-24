@extends('layouts.admin')

@section('title', 'Urgent Infos')
@section('header', 'Urgent Infos')

@section('content')
  <div class="space-y-5">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
      <form method="GET" class="flex flex-col gap-2 sm:flex-row sm:items-center sm:gap-2">
        <input name="q" value="{{ $q ?? '' }}" placeholder="Rechercher..."
               class="w-full sm:w-72 rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-2.5 text-sm text-white/90 outline-none" />

        <select name="level"
                class="w-full sm:w-44 rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-2.5 text-sm text-white/90 outline-none">
          <option value="">Tous niveaux</option>
          @foreach($levels as $lv)
            <option value="{{ $lv }}" @selected((string)$level === (string)$lv)>{{ strtoupper($lv) }}</option>
          @endforeach
        </select>

        {{-- <select name="active"
                class="w-full sm:w-44 rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-2.5 text-sm text-white/90 outline-none">
          <option value="">Actif + Inactif</option>
          <option value="1" @selected((string)$active === '1')>Actif</option>
          <option value="0" @selected((string)$active === '0')>Inactif</option>
        </select> --}}

        <button class="rounded-2xl bg-white/10 px-4 py-2.5 text-sm font-semibold text-white/90 hover:bg-white/14 transition">
          OK
        </button>

        <a href="{{ route('admin.urgent.index') }}"
           class="rounded-2xl bg-white/6 ring-1 ring-white/10 px-4 py-2.5 text-sm font-semibold text-white/80 hover:bg-white/10 transition">
          Reset
        </a>
      </form>

      <a href="{{ route('admin.urgent.create') }}"
         class="rounded-2xl px-4 py-2.5 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
         style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
        Nouvelle info urgente
      </a>
    </div>

    <div class="grid gap-4">
      @forelse($urgentInfos as $u)
        <div class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-5 backdrop-blur flex items-start justify-between gap-4">
          <div class="min-w-0">
            <div class="flex flex-wrap items-center gap-2">
              <div class="text-sm font-extrabold text-white/95 truncate">{{ $u->title }}</div>

              <span class="inline-flex items-center rounded-full border border-white/10 bg-black/25 px-3 py-1 text-xs font-semibold text-white/80">
                {{ strtoupper($u->level) }}
              </span>

              <span class="inline-flex items-center rounded-full border border-white/10 px-3 py-1 text-xs font-semibold
                           {{ $u->active ? 'bg-emerald-400/15 text-emerald-100' : 'bg-white/8 text-white/70' }}">
                {{ $u->active ? 'Actif' : 'Inactif' }}
              </span>
            </div>

            <div class="mt-2 text-sm text-white/70 line-clamp-2">
              {{ $u->message }}
            </div>

            <div class="mt-3 flex flex-wrap items-center gap-3 text-xs text-white/55">
              <span>Début: <span class="text-white/80 font-semibold">{{ $u->starts_at?->format('d M Y H:i') ?? '—' }}</span></span>
              <span>Fin: <span class="text-white/80 font-semibold">{{ $u->ends_at?->format('d M Y H:i') ?? '—' }}</span></span>
              <span>Créé: <span class="text-white/80 font-semibold">{{ $u->created_at?->format('d M Y') ?? '—' }}</span></span>
            </div>
          </div>

          <div class="shrink-0 flex items-center gap-2">
            <a href="{{ route('admin.urgent.edit', $u) }}"
               class="rounded-2xl bg-white/10 px-3 py-2 text-sm font-semibold text-white/90 hover:bg-white/14 transition">
              Modifier
            </a>

            <form method="POST" action="{{ route('admin.urgent.destroy', $u) }}"
                  onsubmit="return confirm('Supprimer cette info urgente ?')">
              @csrf
              @method('DELETE')
              <button class="rounded-2xl bg-red-500/20 px-3 py-2 text-sm font-semibold text-red-100 hover:bg-red-500/30 transition">
                Supprimer
              </button>
            </form>
          </div>
        </div>
      @empty
        <div class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-8 text-center text-white/70">
          Aucune info urgente.
        </div>
      @endforelse
    </div>

    <div>{{ $urgentInfos->links() }}</div>
  </div>
@endsection