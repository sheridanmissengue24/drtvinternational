{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/actualites/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Nouvelle actualité')
@section('header', 'Nouvelle actualité')

@section('content')
  <div class="space-y-5">
    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-6 shadow-soft">
      <h2 class="text-sm font-extrabold tracking-tight text-white/95">Créer une actualité</h2>
      <p class="mt-2 text-sm text-white/65">Remplissez les champs puis publiez ou sauvegardez en brouillon.</p>
    </div>

    <form method="POST" action="{{ route('admin.actualites.store') }}"
          enctype="multipart/form-data"
          class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-6 shadow-soft">
      @csrf
      @include('admin.actualites._form', ['mediaItems' => $mediaItems, 'authors' => $authors])
    </form>
  </div>
@endsection