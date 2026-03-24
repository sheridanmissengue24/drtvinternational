{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/actualites/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Actualités')
@section('header', 'Actualités')

@section('content')
  <div class="space-y-5">
    @if(session('success'))
      <div class="rounded-2xl bg-white/10 ring-1 ring-white/10 p-4 text-sm text-white/90">
        {{ session('success') }}
      </div>
    @endif

    <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
      <form method="GET" class="flex-1">
        <div class="flex flex-col gap-2 sm:flex-row">
          <div class="relative w-full max-w-xl">
            <input name="q" value="{{ $q ?? '' }}" placeholder="Rechercher (titre, chapo)…"
                   class="w-full rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-2.5 text-sm text-white/90 placeholder:text-white/35 outline-none focus:ring-2 focus:ring-[var(--accent)]" />
          </div>

          <select name="status"
                  class="w-full sm:w-56 rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-2.5 text-sm text-white/90 outline-none focus:ring-2 focus:ring-[var(--accent)]">
            <option value="" @selected(($status ?? '')==='')>Tous statuts</option>
            <option value="draft" @selected(($status ?? '')==='draft')>Brouillon</option>
            <option value="published" @selected(($status ?? '')==='published')>Publié</option>
          </select>

          <button class="rounded-2xl bg-white/10 ring-1 ring-white/10 px-4 py-2.5 text-sm font-semibold text-white/90 hover:bg-white/14 transition">
            Filtrer
          </button>
        </div>
      </form>

      <a href="{{ route('admin.actualites.create') }}"
         class="inline-flex items-center justify-center rounded-2xl px-4 py-2.5 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
         style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
        Nouvelle actualité
      </a>
    </div>

    <div class="grid gap-4 lg:grid-cols-2">
      @forelse($actualites as $a)
        <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-5 hover:bg-white/10 transition">
          <div class="flex items-start justify-between gap-4">
            <div class="min-w-0">
              <div class="truncate text-base font-extrabold tracking-tight text-white/95">
                {{ $a->title }}
              </div>
              <div class="mt-1 truncate text-sm text-white/65">
                {{ $a->chapo ?? '—' }}
              </div>

              <div class="mt-3 flex flex-wrap items-center gap-2 text-xs text-white/55">
                <span class="rounded-full bg-white/8 ring-1 ring-white/10 px-3 py-1">
                  /{{ $a->slug }}
                </span>

                <span class="rounded-full bg-white/8 ring-1 ring-white/10 px-3 py-1">
                  Auteur: {{ $a->author?->name ?? '—' }}
                </span>

                <span class="rounded-full bg-white/8 ring-1 ring-white/10 px-3 py-1">
                  Vues: {{ number_format($a->views_count) }}
                </span>
              </div>
            </div>

            <div class="shrink-0 text-right">
              @if($a->status === 'published')
                <div class="inline-flex items-center gap-2 rounded-full bg-white/10 ring-1 ring-white/10 px-3 py-1 text-xs font-semibold text-white/85">
                  <span class="h-2 w-2 rounded-full" style="background: var(--accent-2);"></span>
                  Publié
                </div>
                <div class="mt-2 text-xs text-white/55">
                  {{ optional($a->published_at)->format('d/m/Y H:i') ?? '—' }}
                </div>
              @else
                <div class="inline-flex items-center gap-2 rounded-full bg-white/6 ring-1 ring-white/10 px-3 py-1 text-xs font-semibold text-white/70">
                  <span class="h-2 w-2 rounded-full bg-white/35"></span>
                  Brouillon
                </div>
              @endif
            </div>
          </div>

          <div class="mt-4 flex items-center justify-between">
            <div class="text-xs text-white/55">
              Média: {{ $a->media_type ? strtoupper($a->media_type) : '—' }}
            </div>

            <div class="flex items-center gap-2">
              <a href="{{ route('admin.actualites.edit', $a) }}"
                 class="rounded-2xl bg-white/10 ring-1 ring-white/10 px-3 py-2 text-xs font-semibold text-white/85 hover:bg-white/14 transition">
                Modifier
              </a>
              <form method="POST" action="{{ route('admin.actualites.destroy', $a) }}"
                    onsubmit="return confirm('Supprimer cette actualité ?');">
                @csrf
                @method('DELETE')
                <button class="rounded-2xl bg-black/30 ring-1 ring-white/10 px-3 py-2 text-xs font-semibold text-white/85 hover:bg-white/14 transition">
                  Supprimer
                </button>
              </form>
            </div>
          </div>
        </div>
      @empty
        <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-6 text-white/70">
          Aucune actualité.
        </div>
      @endforelse
    </div>

    <div class="text-white/80">
      {{ $actualites->links() }}
    </div>
  </div>
@endsection