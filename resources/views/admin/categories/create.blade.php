{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/categories/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Nouvelle catégorie')
@section('header', 'Nouvelle catégorie')

@section('content')
  <form method="POST" action="{{ route('admin.categories.store') }}"
        class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-6 shadow-soft">
    @csrf
    @include('admin.categories._form')
  </form>
@endsection