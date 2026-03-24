{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/users/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Nouvel utilisateur')
@section('header', 'Nouvel utilisateur')

@section('content')
  <form method="POST" action="{{ route('admin.users.store') }}"
        class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-6 shadow-soft">
    @csrf
    @include('admin.users._form', ['roles' => $roles])
  </form>
@endsection