{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('title', 'Créer un compte')

@section('content')
<section class="relative overflow-hidden bg-dark text-white">
  <div class="pointer-events-none absolute inset-0">
    <div class="absolute -top-24 -left-24 h-80 w-80 rounded-full blur-3xl opacity-30"
         style="background: radial-gradient(circle, var(--accent), transparent 60%);"></div>
    <div class="absolute -bottom-24 -right-24 h-96 w-96 rounded-full blur-3xl opacity-25"
         style="background: radial-gradient(circle, var(--accent-2), transparent 60%);"></div>
    <div class="absolute inset-0 opacity-[0.06]"
         style="background-image: linear-gradient(to right, #fff 1px, transparent 1px),
                                linear-gradient(to bottom, #fff 1px, transparent 1px);
                background-size: 32px 32px;"></div>
  </div>

  <div class="relative mx-auto max-w-md px-6 py-14">
    <div class="rounded-3xl border border-white/10 bg-white/5 p-7 shadow-2xl backdrop-blur-xl">
      <h1 class="text-2xl font-extrabold tracking-tight">Créer un compte</h1>
      <p class="mt-2 text-sm text-white/70">Inscription simple (accès admin selon rôle).</p>

      @if ($errors->any())
        <div class="mt-4 rounded-2xl border border-red-500/20 bg-red-500/10 p-4 text-sm text-red-100">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('register.store') }}" class="mt-6 space-y-4">
        @csrf

        <div>
          <label class="text-xs font-semibold text-white/70">Nom</label>
          <input name="name" value="{{ old('name') }}" required
                 class="mt-2 w-full rounded-2xl border border-white/10 bg-black/30 px-4 py-3 text-sm text-white placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-[var(--accent)]">
        </div>

        <div>
          <label class="text-xs font-semibold text-white/70">Email</label>
          <input name="email" type="email" value="{{ old('email') }}" required
                 class="mt-2 w-full rounded-2xl border border-white/10 bg-black/30 px-4 py-3 text-sm text-white placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-[var(--accent)]">
        </div>

        <div>
          <label class="text-xs font-semibold text-white/70">Mot de passe</label>
          <input name="password" type="password" required
                 class="mt-2 w-full rounded-2xl border border-white/10 bg-black/30 px-4 py-3 text-sm text-white placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-[var(--accent)]">
        </div>

        <div>
          <label class="text-xs font-semibold text-white/70">Confirmer</label>
          <input name="password_confirmation" type="password" required
                 class="mt-2 w-full rounded-2xl border border-white/10 bg-black/30 px-4 py-3 text-sm text-white placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-[var(--accent)]">
        </div>

        <button class="w-full rounded-2xl px-6 py-3 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
                style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
          Créer mon compte
        </button>

        <a href="{{ route('login') }}" class="mt-2 block text-center text-xs font-semibold text-white/75 hover:text-white transition">
          Déjà un compte ? Se connecter
        </a>
      </form>
    </div>
  </div>
</section>
@endsection