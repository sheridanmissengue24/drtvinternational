<?php
// filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/database/seeders/ProgrammeSeeder.php

namespace Database\Seeders;

use App\Models\Programme;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProgrammeSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Matinale DRTV',
                'category' => 'Information',
                'excerpt' => "Les titres, l’actualité et les invités pour bien démarrer la journée.",
                'description' => "Une matinale rythmée : actualités, revue de presse, météo, circulation et invités.\nRubriques courtes et efficaces, avec une approche pédagogique.",
                'starts_at' => now()->startOfDay()->addHours(7),
                'ends_at' => now()->startOfDay()->addHours(9),
                'is_featured' => true,
                'is_active' => true,
                'cover_url' => 'https://images.unsplash.com/photo-1495020689067-958852a7765e?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Le Grand Débat',
                'category' => 'Société',
                'excerpt' => "Décryptage, opinions et échanges en profondeur.",
                'description' => "Un plateau d’experts et de citoyens pour analyser les sujets qui font l’actualité.\nObjectif : comprendre, contextualiser, comparer les points de vue.",
                'starts_at' => now()->startOfDay()->addHours(19),
                'ends_at' => now()->startOfDay()->addHours(20)->addMinutes(30),
                'is_featured' => true,
                'is_active' => true,
                'cover_url' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Focus Économie',
                'category' => 'Économie',
                'excerpt' => "Marchés, emploi, entrepreneuriat et solutions locales.",
                'description' => "Analyses, chiffres clés, et portraits d’entrepreneurs.\nUne émission orientée terrain et impact.",
                'starts_at' => now()->startOfDay()->addHours(12),
                'ends_at' => now()->startOfDay()->addHours(12)->addMinutes(45),
                'is_featured' => false,
                'is_active' => true,
                'cover_url' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Culture & Scène',
                'category' => 'Culture',
                'excerpt' => "Musique, cinéma, littérature : l’agenda et les coups de cœur.",
                'description' => "Interviews d’artistes, critiques et recommandations.\nUn format vivant et accessible.",
                'starts_at' => now()->startOfDay()->addHours(16),
                'ends_at' => now()->startOfDay()->addHours(16)->addMinutes(50),
                'is_featured' => false,
                'is_active' => true,
                'cover_url' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Santé & Bien-être',
                'category' => 'Santé',
                'excerpt' => "Prévention, conseils et réponses d’experts.",
                'description' => "Hygiène de vie, santé mentale, nutrition.\nDes conseils concrets et des échanges avec des professionnels.",
                'starts_at' => now()->startOfDay()->addHours(10),
                'ends_at' => now()->startOfDay()->addHours(10)->addMinutes(40),
                'is_featured' => false,
                'is_active' => true,
                'cover_url' => 'https://images.unsplash.com/photo-1511174511562-5f7f18b874f8?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Tech & Innovation',
                'category' => 'Technologie',
                'excerpt' => "IA, mobile, startups : tendances et usages.",
                'description' => "On vulgarise la tech : cas d’usage, démos, impacts.\nInvités: développeurs, fondateurs, experts.",
                'starts_at' => now()->startOfDay()->addHours(14),
                'ends_at' => now()->startOfDay()->addHours(14)->addMinutes(45),
                'is_featured' => false,
                'is_active' => true,
                'cover_url' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Sport Live',
                'category' => 'Sport',
                'excerpt' => "Scores, analyses, invités et coulisses.",
                'description' => "Résumés, interviews, et débats.\nUne émission rythmée pour rester au plus près du jeu.",
                'starts_at' => now()->startOfDay()->addHours(21),
                'ends_at' => now()->startOfDay()->addHours(22),
                'is_featured' => false,
                'is_active' => true,
                'cover_url' => 'https://images.unsplash.com/photo-1521412644187-c49fa049e84d?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Éducation & Avenir',
                'category' => 'Éducation',
                'excerpt' => "Orientation, méthodes, et initiatives inspirantes.",
                'description' => "Témoignages d’enseignants, élèves et parents.\nFocus sur les outils et projets qui transforment l’apprentissage.",
                'starts_at' => now()->startOfDay()->addHours(11),
                'ends_at' => now()->startOfDay()->addHours(11)->addMinutes(45),
                'is_featured' => false,
                'is_active' => true,
                'cover_url' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Le Journal',
                'category' => 'Information',
                'excerpt' => "Les infos essentielles, claires et vérifiées.",
                'description' => "Flash, reportages, correspondants.\nUn rendez-vous régulier pour suivre l’actualité.",
                'starts_at' => now()->startOfDay()->addHours(13),
                'ends_at' => now()->startOfDay()->addHours(13)->addMinutes(20),
                'is_featured' => true,
                'is_active' => true,
                'cover_url' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Talk Show DRTV',
                'category' => 'Divertissement',
                'excerpt' => "Invités, humour, actus pop — format premium.",
                'description' => "Un talk show moderne: interviews, chroniques, séquences interactives.\nAmbiance détendue, mais contenu solide.",
                'starts_at' => now()->startOfDay()->addHours(18),
                'ends_at' => now()->startOfDay()->addHours(19),
                'is_featured' => true,
                'is_active' => true,
                'cover_url' => 'https://images.unsplash.com/photo-1520975958225-1a268d0d1b6b?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Planète',
                'category' => 'Environnement',
                'excerpt' => "Climat, biodiversité, solutions et actions locales.",
                'description' => "Reportages et analyses.\nObjectif : informer et rendre les solutions accessibles.",
                'starts_at' => now()->startOfDay()->addHours(15),
                'ends_at' => now()->startOfDay()->addHours(15)->addMinutes(40),
                'is_featured' => false,
                'is_active' => true,
                'cover_url' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=1600&q=80',
            ],
            [
                'title' => 'Nuit Chill',
                'category' => 'Musique',
                'excerpt' => "Ambiance douce, sélection chill pour finir la journée.",
                'description' => "Une programmation posée avec des transitions propres.\nIdéal pour travailler ou se détendre.",
                'starts_at' => now()->startOfDay()->addHours(23),
                'ends_at' => now()->addDay()->startOfDay()->addHours(1),
                'is_featured' => false,
                'is_active' => true,
                'cover_url' => 'https://images.unsplash.com/photo-1496307653780-42ee777d4833?auto=format&fit=crop&w=1600&q=80',
            ],
        ];

        foreach ($items as $it) {
            $slug = Str::slug($it['title']);

            Programme::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $it['title'],
                    'slug' => $slug,
                    'excerpt' => $it['excerpt'] ?? null,
                    'description' => $it['description'] ?? null,
                    'cover_url' => $it['cover_url'] ?? null,
                    'category' => $it['category'] ?? null,
                    'starts_at' => $it['starts_at'] ?? null,
                    'ends_at' => $it['ends_at'] ?? null,
                    'is_featured' => (bool) ($it['is_featured'] ?? false),
                    'is_active' => (bool) ($it['is_active'] ?? true), // FORCE ACTIVE DEFAULT
                ]
            );
        }
    }
}