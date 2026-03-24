@extends('layouts.app')

@section('title', 'Contact')

@section('content')

{{-- HERO --}}
<section class="bg-gradient-to-br from-black via-gray-900 to-black text-white py-24">
  <div class="max-w-7xl mx-auto px-6">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-4">
      Contacter nous
    </h1>
    <p class="text-gray-300 max-w-2xl">
      Partenariats, publicité, diffusion de contenus ou informations.
      Notre équipe vous répond rapidement.
    </p>
  </div>
</section>

{{-- CONTACT --}}
<section class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-3 gap-12">

    {{-- INFOS --}}
    <div class="space-y-6">
      <h2 class="text-2xl font-bold">
        Nos coordonnées
      </h2>

      <div class="bg-white p-6 rounded-xl shadow">
        <p class="font-semibold"> Adresse</p>
        <p class="text-gray-600 text-sm">
          Case J 421 V OCH, MOUNGALI 3 Rue de la Morgue en face des immeubles des italiens
        </p>
      </div>

      <div class="bg-white p-6 rounded-xl shadow">
        <p class="font-semibold"> Email</p>
        <p class="text-gray-600 text-sm">
          contact@drtv.cg
        </p>
      </div>

      <div class="bg-white p-6 rounded-xl shadow">
        <p class="font-semibold"> Téléphone</p>
        <p class="text-gray-600 text-sm">
          +242 05 559 52 11 / 06 651 07 67
        </p>
      </div>

      <div class="bg-gradient-to-br from-black via-gray-900 to-black text-white p-6 rounded-xl">
        <p class="font-semibold mb-2">Opportunités médias</p>
        <p class="text-sm text-gray-300">
          Publicité • Sponsoring • Couverture événementielle • Diffusion de programmes
        </p>
      </div>
    </div>

    {{-- FORMULAIRE --}}
    <div class="lg:col-span-2 bg-white rounded-xl shadow p-8">

      <h2 class="text-2xl font-bold mb-6">
        Envoyez-nous un message
      </h2>

      @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-6">
          {{ session('success') }}
        </div>
      @endif

      <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <input
            type="text"
            name="name"
            placeholder="Nom complet"
            required
            class="w-full border rounded-lg px-4 py-3 "
          >

          <input
            type="email"
            name="email"
            placeholder="Adresse email"
            required
            class="w-full border rounded-lg px-4 py-3 "
          >
        </div>

        <input
          type="text"
          name="subject"
          placeholder="Sujet"
          required
          class="w-full border rounded-lg px-4 py-3 "
        >

        <textarea
          name="message"
          rows="6"
          placeholder="Votre message..."
          required
          class="w-full border rounded-lg px-4 py-3"
        ></textarea>

        <button
          type="submit"
          class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-semibold transition"
        >
          Envoyer le message
        </button>
      </form>

    </div>

  </div>
</section>

{{-- CTA --}}
<section class="bg-gradient-to-br from-black via-gray-900 to-black text-white py-20 text-center">
  <div class="max-w-4xl mx-auto px-6">
    <h2 class="text-3xl font-extrabold mb-4">
      Vous souhaitez collaborer avec DRTV ?
    </h2>
    <p class="text-gray-300 mb-8">
      Touchez une audience nationale et internationale grâce à nos plateformes.
    </p>

    <a href="{{ route('vod.index') }}"
       class="inline-block bg-red-600 hover:bg-red-700 px-10 py-4 rounded-xl font-semibold">
      Découvrir nos contenus
    </a>
  </div>
</section>

@endsection
