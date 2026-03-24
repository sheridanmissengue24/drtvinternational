{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/errors/500.blade.php --}}
@extends('errors.base')

@section('title', 'Erreur serveur (500)')
@section('description', "Une erreur interne est survenue. Notre équipe a été notifiée si nécessaire.")

@section('content')
  <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Erreur 500</div>
  <h1 class="mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-white/95">Erreur interne</h1>
  <p class="mt-3 text-sm text-white/70">
    Une erreur est survenue côté serveur. Réessayez dans quelques instants.
  </p>
@endsection