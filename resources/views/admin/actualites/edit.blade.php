{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/actualites/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Modifier actualité')
@section('header', 'Modifier actualité')

@section('content')
  <div class="space-y-5">
    <div class="rounded-3xl bg-white/8 ring-1 ring-white/10 p-6 shadow-soft">
      <h2 class="text-sm font-extrabold tracking-tight text-white/95">Modifier</h2>
      <p class="mt-2 text-sm text-white/65">Mettez à jour l’actualité puis enregistrez.</p>
    </div>

    <form method="POST" action="{{ route('admin.actualites.update', $actualite) }}"
          enctype="multipart/form-data"
          class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-6 shadow-soft">
      @csrf
      @method('PUT')
      @include('admin.actualites._form', ['actualite' => $actualite, 'mediaItems' => $mediaItems, 'authors' => $authors])
    </form>
  </div>
@endsection