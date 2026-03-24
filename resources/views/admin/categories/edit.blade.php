{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/categories/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Modifier catégorie')
@section('header', 'Modifier catégorie')

@section('content')
  <form method="POST" action="{{ route('admin.categories.update', $category) }}"
        class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-6 shadow-soft">
    @csrf
    @method('PUT')
    @include('admin.categories._form', ['category' => $category])
  </form>
@endsection