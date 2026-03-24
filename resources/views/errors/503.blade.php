{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/errors/503.blade.php --}}
@extends('errors.base')

@section('title', 'Maintenance (503)')
@section('description', "La plateforme est temporairement indisponible pour maintenance.")

@section('content')
  <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Erreur 503</div>
  <h1 class="mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-white/95">Maintenance</h1>
  <p class="mt-3 text-sm text-white/70">
    La plateforme est temporairement indisponible. Merci de réessayer plus tard.
  </p>
@endsection