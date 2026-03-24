{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/errors/429.blade.php --}}
@extends('errors.base')

@section('title', 'Trop de requêtes (429)')
@section('description', "Trop de requêtes. Veuillez patienter avant de réessayer.")

@section('content')
  <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Erreur 429</div>
  <h1 class="mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-white/95">Trop de requêtes</h1>
  <p class="mt-3 text-sm text-white/70">
    Vous avez effectué trop de requêtes en peu de temps. Veuillez patienter puis réessayer.
  </p>
@endsection