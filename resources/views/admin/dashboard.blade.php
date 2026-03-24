{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
@php
  // Best-effort KPI sources:
  // 1) variables passed by controller (preferred)
  // 2) fallback direct model counts (wrapped in try/catch)

  $kpi = [
    'actualites_total' => $actualites_total ?? null,
    'actualites_published' => $actualites_published ?? null,
    'categories_total' => $categories_total ?? null,
    'programmes_total' => $programmes_total ?? null,
    'media_total' => $media_total ?? null,
    'urgent_total' => $urgent_total ?? null,

    // Users KPIs (new)
    'users_total' => $users_total ?? null,
    'admins_total' => $admins_total ?? null,
  ];

  try {
    $kpi['actualites_total'] = $kpi['actualites_total'] ?? (\App\Models\Actualite::query()->count());
    $kpi['actualites_published'] = $kpi['actualites_published'] ?? (\App\Models\Actualite::query()->where('status', 'published')->count());
  } catch (\Throwable $e) {}

  try { $kpi['categories_total'] = $kpi['categories_total'] ?? (\App\Models\Category::query()->count()); } catch (\Throwable $e) {}
  try { $kpi['programmes_total'] = $kpi['programmes_total'] ?? (\App\Models\Programme::query()->count()); } catch (\Throwable $e) {}
  try { $kpi['media_total'] = $kpi['media_total'] ?? (\App\Models\MediaItem::query()->count()); } catch (\Throwable $e) {}
  try { $kpi['urgent_total'] = $kpi['urgent_total'] ?? (\App\Models\UrgentInfo::query()->count()); } catch (\Throwable $e) {}

  // Fallback: users counts
  try { $kpi['users_total'] = $kpi['users_total'] ?? (\App\Models\User::query()->count()); } catch (\Throwable $e) {}
  try { $kpi['admins_total'] = $kpi['admins_total'] ?? (\App\Models\User::query()->where('role', 'admin')->count()); } catch (\Throwable $e) {}

  $num = fn ($v) => is_null($v) ? '—' : number_format((int) $v, 0, ',', ' ');
@endphp

{{-- HERO --}}
<section class="relative overflow-hidden rounded-3xl bg-dark ring-1 ring-white/10 shadow-2xl">
  <div class="pointer-events-none absolute inset-0">
    <div class="absolute -top-24 -left-24 h-80 w-80 rounded-full blur-3xl opacity-30"
         style="background: radial-gradient(circle, rgba(229,0,119,0.55), transparent 60%);"></div>
    <div class="absolute -bottom-24 -right-24 h-96 w-96 rounded-full blur-3xl opacity-25"
         style="background: radial-gradient(circle, rgba(0,206,255,0.45), transparent 60%);"></div>

    <div class="absolute inset-0 opacity-[0.06]"
         style="background-image: linear-gradient(to right, #fff 1px, transparent 1px),
                                linear-gradient(to bottom, #fff 1px, transparent 1px);
                background-size: 32px 32px;"></div>

    <div class="absolute inset-0"
         style="background: radial-gradient(900px 260px at 88% 0%, rgba(244,13,171,0.14), transparent 62%);"></div>
  </div>

  <div class="relative px-6 py-10 sm:px-8 sm:py-12">
    <div class="relative flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
      <div class="min-w-0">
        <div class="inline-flex items-center gap-2 rounded-full bg-white/10 ring-1 ring-white/10 px-3 py-1 text-xs font-semibold text-white/85">
          <span class="inline-flex h-2 w-2 rounded-full"
                style="background: var(--accent); box-shadow: 0 0 14px rgba(229,0,119,0.55);"></span>
          Vue d’ensemble
        </div>

        <h1 class="mt-4 text-2xl sm:text-3xl font-extrabold tracking-tight text-white/95">
          Administration DRTV
        </h1>
        <p class="mt-2 text-sm text-white/75 max-w-2xl">
          {{-- Interface premium pour piloter vos contenus, modules et publications (style dark clair). --}}
        </p>
      </div>

      <div class="flex flex-wrap gap-2">
        <a href="{{ route('actualites.index') }}"
           class="inline-flex items-center justify-center rounded-2xl bg-white/10 ring-1 ring-white/10 px-4 py-2.5 text-sm font-semibold text-white/90 hover:bg-white/14 transition">
          Site
        </a>

        <a href="{{ route('admin.actualites.create') }}"
           class="inline-flex items-center justify-center rounded-2xl px-4 py-2.5 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
           style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
          Nouvelle actualité
        </a>
      </div>
    </div>
  </div>
</section>

{{-- KPI GRID --}}
<div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
  {{-- Actualités --}}
  @if(\Illuminate\Support\Facades\Route::has('admin.actualites.index'))
    <a href="{{ route('admin.actualites.index') }}"
       class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-5 shadow-soft backdrop-blur transition hover:bg-white/8 hover:ring-white/15">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Actualités</div>
      <div class="mt-2 text-2xl font-extrabold text-white/95">{{ $num($kpi['actualites_total']) }}</div>
      <div class="mt-1 text-xs text-white/60">Publiées : {{ $num($kpi['actualites_published']) }}</div>
    </a>
  @else
    <div class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-5 shadow-soft backdrop-blur">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Actualités</div>
      <div class="mt-2 text-2xl font-extrabold text-white/70">{{ $num($kpi['actualites_total']) }}</div>
      <div class="mt-1 text-xs text-white/50">Route admin.actualites.index absente</div>
    </div>
  @endif

  {{-- Catégories --}}
  @if(\Illuminate\Support\Facades\Route::has('admin.categories.index'))
    <a href="{{ route('admin.categories.index') }}"
       class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-5 shadow-soft backdrop-blur transition hover:bg-white/8 hover:ring-white/15">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Catégories</div>
      <div class="mt-2 text-2xl font-extrabold text-white/95">{{ $num($kpi['categories_total']) }}</div>
      <div class="mt-1 text-xs text-white/60"></div>
    </a>
  @else
    <div class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-5 shadow-soft backdrop-blur">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Catégories</div>
      <div class="mt-2 text-2xl font-extrabold text-white/70">{{ $num($kpi['categories_total']) }}</div>
      <div class="mt-1 text-xs text-white/50">Route admin.categories.index absente</div>
    </div>
  @endif

  {{-- Programmes --}}
  @if(\Illuminate\Support\Facades\Route::has('admin.programmes.index'))
    <a href="{{ route('admin.programmes.index') }}"
       class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-5 shadow-soft backdrop-blur transition hover:bg-white/8 hover:ring-white/15">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Programmes</div>
      <div class="mt-2 text-2xl font-extrabold text-white/95">{{ $num($kpi['programmes_total']) }}</div>
      <div class="mt-1 text-xs text-white/60"></div>
    </a>
  @else
    <div class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-5 shadow-soft backdrop-blur">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Programmes</div>
      <div class="mt-2 text-2xl font-extrabold text-white/70">{{ $num($kpi['programmes_total']) }}</div>
      <div class="mt-1 text-xs text-white/50">Route admin.programmes.index absente</div>
    </div>
  @endif

  {{-- Urgent --}}
  @if(\Illuminate\Support\Facades\Route::has('admin.urgent.index'))
    <a href="{{ route('admin.urgent.index') }}"
       class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-5 shadow-soft backdrop-blur transition hover:bg-white/8 hover:ring-white/15">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Urgent</div>
      <div class="mt-2 text-2xl font-extrabold text-white/95">{{ $num($kpi['urgent_total']) }}</div>
      <div class="mt-1 text-xs text-white/60">Infos</div>
    </a>
  @else
    <div class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-5 shadow-soft backdrop-blur">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Urgent</div>
      <div class="mt-2 text-2xl font-extrabold text-white/70">{{ $num($kpi['urgent_total']) }}</div>
      <div class="mt-1 text-xs text-white/50">Route admin.urgent.index absente</div>
    </div>
  @endif

  {{-- Médias (si ton projet a ce KPI/route) --}}
  {{-- @if(\Illuminate\Support\Facades\Route::has('admin.media.index'))
    <a href="{{ route('admin.media.index') }}"
       class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-5 shadow-soft backdrop-blur transition hover:bg-white/8 hover:ring-white/15">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Médias</div>
      <div class="mt-2 text-2xl font-extrabold text-white/95">{{ $num($kpi['media_total']) }}</div>
      <div class="mt-1 text-xs text-white/60">Items</div>
    </a>
  @else
    <div class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-5 shadow-soft backdrop-blur">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Médias</div>
      <div class="mt-2 text-2xl font-extrabold text-white/70">{{ $num($kpi['media_total']) }}</div>
      <div class="mt-1 text-xs text-white/50">Route admin.media.index absente</div>
    </div>
  @endif --}}

  {{-- Utilisateurs (NEW) --}}
  @if(\Illuminate\Support\Facades\Route::has('admin.users.index'))
    <a href="{{ route('admin.users.index') }}"
       class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-5 shadow-soft backdrop-blur transition hover:bg-white/8 hover:ring-white/15">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Utilisateurs</div>
      <div class="mt-2 text-2xl font-extrabold text-white/95">{{ $num($kpi['users_total']) }}</div>
      <div class="mt-1 text-xs text-white/60">Admins : {{ $num($kpi['admins_total']) }}</div>
    </a>
  @else
    <div class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-5 shadow-soft backdrop-blur">
      <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Utilisateurs</div>
      <div class="mt-2 text-2xl font-extrabold text-white/70">{{ $num($kpi['users_total']) }}</div>
      <div class="mt-1 text-xs text-white/50">Route admin.users.index absente</div>
    </div>
  @endif
</div>

{{-- Content blocks --}}
<div class="mt-8 grid gap-4 lg:grid-cols-12">
  <div class="lg:col-span-7 rounded-3xl bg-white/6 ring-1 ring-white/10 p-6 shadow-soft backdrop-blur">
    <div class="flex items-center justify-between">
      <div>
        <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Activité</div>
        <div class="mt-2 text-lg font-extrabold text-white/95">Derniers éléments</div>
      </div>
    </div>

    <div class="mt-4 text-sm text-white/70">
      {{-- Place your latest items widget here --}}
      <div class="rounded-2xl bg-black/20 ring-1 ring-white/10 p-4 text-white/65">
        À connecter à vos dernières actualités/programmes…
      </div>
    </div>
  </div>

  <div class="lg:col-span-5 rounded-3xl bg-white/6 ring-1 ring-white/10 p-6 shadow-soft backdrop-blur">
    <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Raccourcis</div>

    <div class="mt-4 grid gap-2 sm:grid-cols-2">
      <a href="{{ route('admin.actualites.create') }}"
         class="rounded-2xl bg-white/8 ring-1 ring-white/10 px-4 py-3 text-sm font-semibold text-white/90 hover:bg-white/12 transition">
        Nouvelle actualité
      </a>

      <a href="{{ route('admin.programmes.index') }}"
         class="rounded-2xl bg-white/8 ring-1 ring-white/10 px-4 py-3 text-sm font-semibold text-white/90 hover:bg-white/12 transition">
        Gérer programmes
      </a>

      <a href="{{ route('admin.urgent.index') }}"
         class="rounded-2xl bg-white/8 ring-1 ring-white/10 px-4 py-3 text-sm font-semibold text-white/90 hover:bg-white/12 transition">
        Infos urgentes
      </a>

      @if(\Illuminate\Support\Facades\Route::has('admin.users.index'))
        <a href="{{ route('admin.users.index') }}"
           class="rounded-2xl bg-white/8 ring-1 ring-white/10 px-4 py-3 text-sm font-semibold text-white/90 hover:bg-white/12 transition">
          Gérer utilisateurs
        </a>
      @else
        <div class="rounded-2xl bg-black/20 ring-1 ring-white/10 px-4 py-3 text-sm font-semibold text-white/50">
          Users: route absente
        </div>
      @endif
    </div>
  </div>
</div>
@endsection