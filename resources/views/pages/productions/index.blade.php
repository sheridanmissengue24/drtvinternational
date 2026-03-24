@extends('layouts.app')

@section('title', 'Nos Productions')

@section('content')

<section class="bg-gray-900 text-white py-24">
    <div class="max-w-6xl mx-auto px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-6">
            Nos Productions Audiovisuelles
        </h1>
        <p class="text-gray-300 max-w-3xl">
            DRTV INTERNATIONAL HD produit des contenus audiovisuels de qualité
            répondant aux standards internationaux.
        </p>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16">

        <div>
            <h3 class="text-2xl font-bold mb-4"> Productions TV</h3>
            <p class="text-gray-600">
                Journaux télévisés, magazines, documentaires, talk-shows.
            </p>
        </div>

        <div>
            <h3 class="text-2xl font-bold mb-4"> Productions Corporate</h3>
            <p class="text-gray-600">
                Films institutionnels, publicités, couvertures d’événements.
            </p>
        </div>

        <div>
            <h3 class="text-2xl font-bold mb-4"> Diffusion & Post-production</h3>
            <p class="text-gray-600">
                Montage, habillage, diffusion multi-plateformes.
            </p>
        </div>

        <div>
            <h3 class="text-2xl font-bold mb-4"> Productions internationales</h3>
            <p class="text-gray-600">
                Coproductions et partenariats médias internationaux.
            </p>
        </div>

    </div>
</section>

@endsection
