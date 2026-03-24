{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/urgent_infos/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Modifier info urgente')
@section('header', 'Modifier info urgente')

@section('content')
  <form method="POST" action="{{ route('admin.urgent.update', $urgent) }}"
        class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-6 shadow-soft">
    @csrf
    @method('PUT')
    @include('admin.urgent_infos._form', ['urgent' => $urgent])
  </form>
@endsection