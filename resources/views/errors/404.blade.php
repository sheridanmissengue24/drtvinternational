{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/errors/404.blade.php --}}
@extends('errors.base')

@section('title', 'Page introuvable (404)')
@section('description', "La page demandée n'existe pas ou a été déplacée.")

@section('content')
  <div class="text-xs font-semibold uppercase tracking-wider text-white/60">Erreur 404</div>
  <h1 class="mt-2 text-2xl sm:text-3xl font-extrabold tracking-tight text-white/95">Page introuvable</h1>
  <p class="mt-3 text-sm text-white/70">
    Le lien est peut-être incorrect, ou la page a été déplacée.
  </p>

  <div class="mt-6 rounded-2xl bg-black/25 ring-1 ring-white/10 p-4 text-xs text-white/65">
    <div class="font-semibold text-white/80">Conseils :</div>
    <ul class="mt-2 list-disc pl-5 space-y-1">
      <li>Vérifie l’URL.</li>
      <li>Reviens à l’accueil, puis navigue depuis le menu.</li>
      <li>Si tu penses que c’est un bug, contacte l’équipe.</li>
    </ul>
  </div>
@endsection