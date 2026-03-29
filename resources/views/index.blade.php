@extends('layouts.app')

@section('title','Accueil')

@section('content')

{{-- URGENT --}}

@if($urgent->active == true)
  <div class="max-w-7xl mx-auto px-4 mt-6 mb-6">
    <div class="rounded-lg p-3 text-sm flex items-start gap-3 shadow-md {{ ($urgent->level ?? 'info') === 'danger' ? 'bg-red-600 text-white' : ((($urgent->level ?? '') === 'warning') ? 'bg-yellow-50 text-yellow-800' : 'bg-[var(--accent-2)] text-white') }}">
      <div class="font-bold">{{ $urgent->title }}</div>
      <div class="flex-1">{!! nl2br(e($urgent->message)) !!}</div>
      {{-- <a href="#" class="ml-3 text-sm underline">Nous contacter</a> --}}
    </div>
  </div>
@endif

@include('components.hero')

{{-- SERVICES / CTA / NEWS etc. (you can keep the previous big home content) --}}
<div class="max-w-7xl mx-auto px-4 -mt-12 relative z-20">

  {{-- Services — condensed for brevity; keep the full services block from previous template if you prefer --}}
  @include('components.services')

  {{-- Latest news --}}
  <section class="py-16 bg-neutral-50">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
          <div class="inline-flex items-center gap-2 rounded-full border border-black/5 bg-white px-4 py-2 text-xs font-semibold text-gray-700 shadow-sm">
            <span class="inline-flex h-2 w-2 rounded-full"
                  style="background: var(--accent); box-shadow: 0 0 14px var(--accent);"></span>
            Dernières actus
          </div>
          <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            À la une
          </h2>
          <p class="mt-2 max-w-2xl text-sm text-gray-600 sm:text-base">
            Les infos, reportages et sujets du moment mis à jour régulièrement.
          </p>
        </div>

        <a href="{{ route('actualites.index') }}"
           class="inline-flex items-center justify-center rounded-full px-5 py-3 text-sm font-semibold text-white shadow-lg transition active:scale-[0.99]"
           style="background: linear-gradient(90deg, var(--accent), var(--accent-2));">
          Voir toutes les actualités
        </a>
      </div>

      @php
        // Supporte $latestNews (recommandé) ou fallback $actualites
        $items = $latestNews ?? $actualites ?? collect();
      @endphp

      @if($items->count())
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
          @foreach($items as $news)
            <x-card-news :news="$news" />
          @endforeach
        </div>
      @else
        <div class="mt-10 rounded-3xl border border-black/5 bg-white p-8 text-center">
          <div class="text-sm font-semibold text-gray-900">Aucune actualité pour le moment</div>
          <div class="mt-2 text-sm text-gray-600">Reviens plus tard pour les dernières mises à jour.</div>
        </div>
      @endif
    </div>
  </section>
  {{-- fin latest news --}}

  {{-- emission  --}}
  @include('components.programmes')
{{-- fin --}}
  @include('components.livetvradio')

  {{-- vod --}}
  @include('components.vod')

  {{-- Contact / Lead form (same as before) --}}
  <section id="contact" class="py-10">
    <div class="bg-[var(--neutral-bg)] rounded-2xl p-6 shadow-lg">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div>
          <h3 class="text-xl font-semibold">Parlons de votre projet</h3>
          <p class="text-sm text-gray-600 mt-2">Notre équipe vous répond sous 48h.</p>
        </div>

        <form action="#" method="POST" class="space-y-3 bg-white rounded-lg p-4">
          @csrf
          <input name="name" required placeholder="Nom complet" class="w-full px-3 py-2 rounded border" />
          <input name="email" type="email" required placeholder="Email" class="w-full px-3 py-2 rounded border" />
          <input name="phone" placeholder="Téléphone (optionnel)" class="w-full px-3 py-2 rounded border" />
          <select name="service" class="w-full px-3 py-2 rounded border">
            <option value="">Service recherché</option>
            <option value="diffusion">Diffusion</option>
            <option value="production">Production</option>
            <option value="pub">Publicité</option>
            {{-- <option value="podcast">Podcast</option> --}}
          </select>
          <textarea name="message" placeholder="Décrivez votre projet" class="w-full px-3 py-2 rounded border" rows="4"></textarea>
          <div class="flex gap-3">
            <button type="submit" class="px-4 py-2 rounded-md btn-primary">Envoyer ma demande</button>
            <a href="mailto:contact@drtv.cg" class="px-4 py-2 rounded-md border text-[var(--accent-dark)]">Envoyer par email</a>
          </div>
        </form>
      </div>
    </div>
  </section>



  @include('components.apk')

</div>

@endsection
