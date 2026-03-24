{{-- filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/resources/views/admin/programmes/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Modifier programme')
@section('header', 'Modifier programme')

@section('content')
  <form method="POST" action="{{ route('admin.programmes.update', $programme) }}" enctype="multipart/form-data"
        class="rounded-3xl bg-white/6 ring-1 ring-white/10 p-6 shadow-soft">
    @csrf
    @method('PUT')
    @include('admin.programmes._form', ['programme' => $programme])
  </form>
@endsection