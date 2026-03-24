{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/pages/auth/login.blade.php --}}
@extends('layouts.auth')

@section('title', 'Connexion')
@section('content')
  @php
    // Put your logo here:
    // public/images/logo.png  -> asset('images/logo.png')
    // public/storage/...      -> asset('storage/...')
    $logoPath = asset('images/logo.png');
  @endphp

  {{-- Logo OUTSIDE the card (full, not clipped) --}}
  <div class="mb-6 flex justify-center">
    <div class="flex flex-col items-center">
      <div class="relative">
        {{-- Glow behind logo --}}
        <div class="pointer-events-none absolute -inset-6 rounded-[2.5rem] blur-2xl opacity-35"
             style="background: radial-gradient(circle, rgba(229,0,119,0.45), transparent 65%);"></div>

        <img src="{{ $logoPath }}"
             alt="{{ env('APP_NAME') }} Logo"
             class="relative h-16 sm:h-20 w-auto object-contain"
             onerror="this.style.display='none';" />

        {{-- Fallback if logo missing --}}
        {{-- <div class="relative inline-flex items-center gap-3 rounded-3xl bg-white/6 ring-1 ring-white/10 px-5 py-3 drtv-ring">
          <div class="h-10 w-10 rounded-2xl drtv-grad"
               style="box-shadow: 0 0 0 1px rgba(255,255,255,0.10) inset;"></div>
          <div class="leading-tight">
            <div class="text-xs font-semibold uppercase tracking-wider text-white/60">DRTV</div>
            <div class="text-sm font-extrabold text-white/95">{{ env('APP_NAME') }}</div>
          </div>
        </div> --}}
      </div>

      <div class="mt-3 h-1.5 w-24 rounded-full drtv-grad opacity-90"></div>
    </div>
  </div>

  <section class="relative overflow-hidden rounded-3xl ring-1 ring-white/10 bg-white/6 backdrop-blur drtv-ring shadow-[0_30px_90px_-50px_rgba(0,0,0,0.9)]">
    {{-- Inner glow --}}
    <div class="pointer-events-none absolute inset-0 opacity-70"
         style="background: radial-gradient(800px 240px at 12% 0%, rgba(229,0,119,0.18), transparent 60%),
                        radial-gradient(800px 240px at 92% 0%, rgba(244,13,171,0.14), transparent 62%);"></div>

    <div class="relative p-6 sm:p-8">
      {{-- Header --}}
      <div class="flex items-center justify-between gap-4">
        <div class="min-w-0">
          <div class="text-xs font-semibold uppercase tracking-wider text-white/60">DRTV</div>
          <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-white/95">Connexion</h1>
          <p class="mt-2 text-sm text-white/65">
            Accédez à l’administration en toute sécurité.
          </p>
        </div>

        <div class="hidden sm:block h-12 w-12 rounded-2xl drtv-grad opacity-90"
             style="box-shadow: 0 0 0 1px rgba(255,255,255,0.10) inset, 0 18px 60px -30px rgba(229,0,119,0.55);"></div>
      </div>

      {{-- Errors --}}
      @if ($errors->any())
        <div class="mt-5 rounded-2xl bg-red-500/10 ring-1 ring-red-500/20 px-4 py-3 text-sm text-red-50">
          <div class="font-semibold">Erreur(s)</div>
          <ul class="mt-2 list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Form --}}
      <form method="POST" action="{{ route('login.store') }}" class="mt-6 space-y-4">
        @csrf

        <div>
          <label class="text-xs font-semibold text-white/70">Email</label>
          <div class="mt-2">
            <input name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                   class="w-full rounded-2xl border border-white/10 bg-black/30 px-4 py-3 text-sm text-white placeholder:text-white/40 outline-none
                          focus:ring-2 focus:ring-[var(--accent)] focus:border-transparent transition
                          hover:border-white/15" />
          </div>
        </div>

        <div>
          <label class="text-xs font-semibold text-white/70">Mot de passe</label>
          <div class="mt-2">
            <input name="password" type="password" required autocomplete="current-password"
                   class="w-full rounded-2xl border border-white/10 bg-black/30 px-4 py-3 text-sm text-white placeholder:text-white/40 outline-none
                          focus:ring-2 focus:ring-[var(--accent)] focus:border-transparent transition
                          hover:border-white/15" />
          </div>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
          <label class="inline-flex items-center gap-2 text-xs text-white/70 select-none">
            <input type="checkbox" name="remember"
                   class="rounded border-white/20 bg-black/30 text-[var(--accent)] focus:ring-[var(--accent)]">
            Se souvenir de moi
          </label>

          <a href="{{ route('register') }}"
             class="text-xs font-semibold underline-offset-4 hover:underline"
             style="color: var(--accent);">
            Créer un compte
          </a>
        </div>

        <button class="btn-sweep w-full rounded-2xl px-6 py-3 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]
                       hover:brightness-[1.03]"
                style="background: linear-gradient(90deg, var(--accent), var(--accent-2)); box-shadow: 0 18px 60px -35px rgba(229,0,119,0.65);">
          Se connecter
        </button>

        <div class="pt-2 text-center text-xs text-white/55">
          Problème d’accès ? Contactez un administrateur.
        </div>
      </form>
    </div>
  </section>
@endsection