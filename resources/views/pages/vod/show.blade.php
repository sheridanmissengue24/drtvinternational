@extends('layouts.app')

@section('title', $video->title)

@section('content')

<section class="bg-gradient-to-br from-black via-gray-900 to-black py-16">
  <div class="max-w-5xl mx-auto px-6">

    <div class="aspect-video rounded-xl overflow-hidden shadow-2xl mb-8">
      <video controls class="w-full h-full bg-black">
        <source src="{{ asset($video->file_path) }}" type="video/mp4">
      </video>
    </div>

    <h1 class="text-3xl font-extrabold text-white mb-4">
      {{ $video->title }}
    </h1>

    <p class="text-gray-300 max-w-3xl">
      {{ $video->description }}
    </p>

  </div>
</section>

@endsection
