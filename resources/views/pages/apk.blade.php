@extends('layouts.app')

@section('title', 'Télécharger l’application DRTV')

@section('content')

{{-- HERO --}}
<section class="relative bg-gradient-to-br from-black via-gray-900 to-black py-24 text-white">
    <div class="absolute inset-0 opacity-20 bg-[url('/images/mobile-tv.jpg')] bg-cover bg-center"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">
                Téléchargez l’application<br>
                <span class="text-red-600">DRTV INTERNATIONAL HD</span>
            </h1>

            <p class="text-gray-300 mb-8">
                Regardez la télévision en direct sur votre smartphone Android.
            </p>

            <a href="{{ asset('apk/drtv.apk') }}"
               class="inline-flex items-center gap-3 px-8 py-4 bg-red-600 rounded-full font-semibold hover:bg-red-700 transition">
                📲 Télécharger l’APK
            </a>

            <p class="text-sm text-gray-400 mt-4">
                Version Android • Fichier officiel • Sécurisé
            </p>
        </div>

        {{-- MOCKUP --}}
        <div class="hidden md:flex justify-center">
            <img src="{{ asset('images/bienvenue.png') }}"
                 alt="Application DRTV"
                 class="max-h-[500px] drop-shadow-2xl">
        </div>
    </div>
</section>

{{-- POURQUOI APK --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-12">
            Pourquoi installer notre application ?
        </h2>

        <div class="grid md:grid-cols-3 gap-10 text-center">

            <div class="p-8 rounded-2xl bg-gray-50 shadow">
                <div class="text-4xl mb-4">📡</div>
                <h3 class="font-bold text-xl mb-2">Live TV </h3>
                <p class="text-gray-600">
                    Regardez DRTV en direct, partout et à tout moment.
                </p>
            </div>

            <div class="p-8 rounded-2xl bg-gray-50 shadow">
                <div class="text-4xl mb-4">🎬</div>
                <h3 class="font-bold text-xl mb-2">Accessible 24H/24</h3>
                <p class="text-gray-600">
                    Suivez nos programmes sans interruptions 24H/24
                </p>
            </div>

            <div class="p-8 rounded-2xl bg-gray-50 shadow">
                <div class="text-4xl mb-4">⚡</div>
                <h3 class="font-bold text-xl mb-2">Rapide & Optimisée</h3>
                <p class="text-gray-600">
                    Application légère, fluide et adaptée aux appareils android
                </p>
            </div>

        </div>
    </div>
</section>

{{-- COMMENT INSTALLER --}}
<section class="py-20 bg-gray-100">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-12">
            Comment installer l’application ?
        </h2>

        <ol class="max-w-3xl mx-auto space-y-6 text-gray-700">
            <li class="flex gap-4">
                <span class="font-bold text-red-600">1.</span>
                Télécharger le fichier APK via le bouton ci-dessus.
            </li>
            <li class="flex gap-4">
                <span class="font-bold text-red-600">2.</span>
                Autoriser l’installation depuis des sources inconnues.
            </li>
            <li class="flex gap-4">
                <span class="font-bold text-red-600">3.</span>
                Installer et lancer l’application DRTV INTERNATIONAL HD.
            </li>
        </ol>
    </div>
</section>

{{-- CTA FINAL --}}
<section class="py-20 bg-black text-white text-center">
    <h2 class="text-3xl font-bold mb-4">
        DRTV INTERNATIONAL HD<br>dans votre poche
    </h2>
    <p class="text-gray-400 mb-8">
        L’information, l’éducation et le divertissement en continu.
    </p>

    <a href="{{ asset('apk/drtv.apk') }}"
       class="px-10 py-4 bg-red-600 rounded-full font-semibold hover:bg-red-700">
        Télécharger maintenant
    </a>
</section>

@endsection
