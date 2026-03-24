{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/categories/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Catégories')
@section('header', 'Catégories')

@section('content')
  <div class="space-y-5">
    <div class="flex items-center justify-between gap-3">
      <form class="flex items-center gap-2" method="GET">
        <input name="q" value="{{ $q ?? '' }}" placeholder="Rechercher..."
               class="rounded-2xl bg-black/25 ring-1 ring-white/10 px-4 py-2.5 text-sm text-white/90 outline-none" />
        <button class="rounded-2xl bg-white/10 px-4 py-2.5 text-sm font-semibold text-white">OK</button>
      </form>

      <a href="{{ route('admin.categories.create') }}"
         class="rounded-2xl px-4 py-2.5 text-sm font-semibold text-white"
         style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
        Nouvelle catégorie
      </a>
    </div>

    <div class="grid gap-4">
      @forelse($categories as $category)
        <div class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-5 flex items-center justify-between gap-4">
          <div class="min-w-0">
            <div class="text-sm font-extrabold text-white/95 truncate">{{ $category->name }}</div>
            <div class="text-xs text-white/60">slug: <span class="font-mono">{{ $category->slug }}</span></div>
          </div>

          <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('admin.categories.edit', $category) }}"
               class="rounded-2xl bg-white/10 px-3 py-2 text-sm font-semibold text-white/90 hover:bg-white/14 transition">
              Modifier
            </a>
            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                  onsubmit="return confirm('Supprimer cette catégorie ?')">
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
          Aucune catégorie.
        </div>
      @endforelse
    </div>

    <div>{{ $categories->links() }}</div>
  </div>
@endsection