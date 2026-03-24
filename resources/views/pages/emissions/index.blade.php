@extends('layouts.app')

@section('title', 'Nos Émissions')

@section('content')

{{-- HERO --}}
<section class="relative min-h-[70vh] flex items-center bg-gradient-to-r from-black via-gray-900 to-black">
    <div class="absolute inset-0 opacity-30 bg-[url('/images/tv-studio.jpg')] bg-cover bg-center"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-6 text-white">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">
            Nos Émissions
        </h1>
        <p class="max-w-2xl text-lg text-gray-200">
            Des programmes d’information, d’éducation et de divertissement conçus
            pour informer, inspirer et rassembler.
        </p>
    </div>
</section>

{{-- LISTE --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-10">

            @for ($i = 0; $i < 6; $i++)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition">
                <img src="https://lorempicture.point-sys.com/400/300/" class="h-48 w-full object-cover">
                <div class="p-6">
                    <h3 class="font-bold text-xl mb-2">LA MATINALE {{ $i }} </h3>
                    <p class="text-gray-600 text-sm mb-4">
                        Description courte de l’émission et de son concept éditorial.
                    </p>
                    <span class="text-sm text-red-600 font-semibold">
                         Hebdomadaire
                    </span>
                </div>
            </div>
            @endfor

        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-black text-white text-center">
    <h2 class="text-3xl font-bold mb-4">
        Vous avez un concept d’émission ?
    </h2>
    <p class="text-gray-300 mb-6">
        Proposez votre émission et diffusez-la sur DRTV INTERNATIONAL HD.
    </p>
    <a href="{{ route('contact.index') }}" class="px-8 py-4 bg-red-600 rounded-full font-semibold hover:bg-red-700">
        Proposer une émission
    </a>
</section>

@endsection
