{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/errors/419.blade.php --}}
@extends('errors.base')

@section('title', 'Session expirée (419)')
@section('description', "Votre session a expiré. Veuillez réessayer.")

@section('content')
  <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Erreur 419</div>
  <h1 class="mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-white/95">Session expirée</h1>
  <p class="mt-3 text-sm text-white/70">
    Pour des raisons de sécurité, votre session a expiré. Réessayez.
  </p>
@endsection