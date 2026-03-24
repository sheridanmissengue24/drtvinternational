@extends('layouts.app')

@section('title', 'VOD')

@section('content')

{{-- HERO --}}
<section class="bg-gradient-to-br from-black via-gray-900 to-black text-white py-24">
  <div class="max-w-7xl mx-auto px-6">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">
      Vidéo à la Demande
    </h1>
    <p class="text-gray-300 max-w-2xl">
      Revivez nos émissions, reportages et programmes exclusifs à tout moment.
    </p>

    <div class="mt-8 flex flex-wrap gap-4">
      <a href="{{ route('live.tv') }}"
         class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-lg font-semibold">
        Regarder le direct
      </a>

      {{-- <a href="#"
         class="border border-white/30 hover:bg-white/10 px-6 py-3 rounded-lg font-semibold">
        Proposer un contenu
      </a> --}}
    </div>
  </div>
</section>

{{-- LISTING --}}
<section class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
      @forelse($videos as $video)
        <x-card-vod :video="$video" />
      @empty
        <p>Aucune vidéo disponible.</p>
      @endforelse
    </div>

    <div class="mt-12">
      {{ $videos->links() }}
    </div>

  </div>
</section>

{{-- CTA BUSINESS --}}
<section class="bg-gradient-to-br from-black via-gray-900 to-black text-white py-20">
  <div class="max-w-5xl mx-auto px-6 text-center">

    <h2 class="text-3xl font-extrabold mb-4">
      Vous avez un programme à diffuser ?
    </h2>

    <p class="text-gray-300 mb-8">
      DRTV INTERNATIONAL HD offre une plateforme de diffusion puissante
      pour vos émissions, reportages et productions.
    </p>

    <a href="#"
       class="inline-block bg-red-600 hover:bg-red-700 px-10 py-4 rounded-xl font-semibold text-lg">
      Collaborer avec DRTV
    </a>

  </div>
</section>

@endsection
