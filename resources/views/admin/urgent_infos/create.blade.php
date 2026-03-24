{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/urgent_infos/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Nouvelle info urgente')
@section('header', 'Nouvelle info urgente')

@section('content')
  <form method="POST" action="{{ route('admin.urgent.store') }}"
        class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-6 shadow-soft">
    @csrf
    @include('admin.urgent_infos._form')
  </form>
@endsection