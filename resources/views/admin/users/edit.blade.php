{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/users/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Modifier utilisateur')
@section('header', 'Modifier utilisateur')

@section('content')
  <form method="POST" action="{{ route('admin.users.update', $user) }}"
        class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-6 shadow-soft">
    @csrf
    @method('PUT')
    @include('admin.users._form', ['user' => $user, 'roles' => $roles])
  </form>
@endsection