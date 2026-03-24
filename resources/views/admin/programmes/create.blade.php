{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/programmes/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Nouveau programme')
@section('header', 'Nouveau programme')

@section('content')
  <form method="POST" action="{{ route('admin.programmes.store') }}" enctype="multipart/form-data"
        class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-6 shadow-soft">
    @csrf
    @include('admin.programmes._form')
  </form>
@endsection