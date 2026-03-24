{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/errors/403.blade.php --}}
@extends('errors.base')

@section('title', 'Accès refusé (403)')
@section('description', "Vous n'avez pas l'autorisation d'accéder à cette ressource.")

@section('content')
  <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Erreur 403</div>
  <h1 class="mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-white/95">Accès refusé</h1>
  <p class="mt-3 text-sm text-white/70">
    Vous n’avez pas les permissions nécessaires pour consulter cette page.
  </p>
@endsection