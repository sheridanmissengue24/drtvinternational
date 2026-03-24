@extends('layouts.app')

@section('title', 'Live TV')

@section('content')

{{-- HERO / PLAYER --}}
<section class="bg-gray-900">
  <div class="max-w-7xl mx-auto px-4 py-12">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">

      {{-- PLAYER --}}
      <div class="lg:col-span-2">
        <div class="relative aspect-video rounded-xl overflow-hidden shadow-2xl border border-white/10">

          {{-- LIVE BADGE --}}
          <div class="absolute top-4 left-4 z-10 bg-red-600 text-white px-4 py-1 rounded-full text-xs font-bold tracking-wide">
            ● EN DIRECT
          </div>

          <iframe src="https://player.castr.com/live_fa91d680268a11f19fb5ef0a56d9304b" width="100%" style="aspect-ratio: 16/9; min-height: 340px;" frameborder="0" scrolling="no" allow="autoplay" allowfullscreen  webkitallowfullscreen mozallowfullscreen oallowfullscreen msallowfullscreen></iframe>
          {{-- @if($livetv)
            <video
              id="live-tv-player"
              controls
              autoplay
              playsinline
              class="w-full h-full bg-black"
            ></video>
          @else
            <div class="flex items-center justify-center h-full text-white">
              <p>Le direct n’est pas disponible actuellement.</p>
            </div>
          @endif --}}

        </div>
      </div>

      {{-- INFO & CTA --}}
      <aside class="space-y-6 text-white">

        <h1 class="text-3xl font-extrabold leading-tight">
          DRTV INTERNATIONAL HD
        </h1>

        <p class="text-gray-300 leading-relaxed">
          Suivez DRTV INTERNATIONAL HD en direct 24h/24.
          Information, éducation et divertissement.
        </p>

        {{-- CTA --}}
        <div class="space-y-4">
          <a href="{{ route('apk') }}"
             class="block text-center bg-red-600 hover:bg-red-700 transition text-white font-semibold py-3 rounded-lg">
            Télécharger l’application mobile
          </a>

          <a href="{{ route('contact.index') }}"
             class="block text-center border border-white/30 hover:bg-white/10 transition py-3 rounded-lg">
            Nous contacter pour publicité
          </a>
        </div>

        {{-- INFOS TECH --}}
        <div class="text-xs text-gray-400 border-t border-white/10 pt-4">
          <p>Diffusion HD • Streaming sécurisé</p>
          <p>Accessible sur mobile, tablette et desktop</p>
        </div>

      </aside>

    </div>
  </div>
</section>

{{-- SECTION PROGRAMMATION --}}
<section class="bg-white py-20">
  <div class="max-w-7xl mx-auto px-6">

    <h2 class="text-2xl font-bold mb-8">
      Pourquoi regarder DRTV ?
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      <div class="p-6 bg-gray-50 rounded-xl">
        <h3 class="font-bold text-lg mb-2">Information fiable</h3>
        <p class="text-gray-600 text-sm">
          Actualités nationales et internationales vérifiées.
        </p>
      </div>

      <div class="p-6 bg-gray-50 rounded-xl">
        <h3 class="font-bold text-lg mb-2">Éducation & Culture</h3>
        <p class="text-gray-600 text-sm">
          Programmes éducatifs et contenus culturels africains.
        </p>
      </div>

      <div class="p-6 bg-gray-50 rounded-xl">
        <h3 class="font-bold text-lg mb-2">Audience internationale</h3>
        <p class="text-gray-600 text-sm">
          Une chaîne suivie par la diaspora et au-delà.
        </p>
      </div>

    </div>

  </div>
</section>

@endsection
