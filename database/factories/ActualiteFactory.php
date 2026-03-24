<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actualite>
 */
class ActualiteFactory extends Factory
{
    protected $model = \App\Models\Actualite::class;

    public function definition()
    {
        $title = $this->faker->sentence(6, true);
        $hasMedia = $this->faker->boolean(75); // 75% have media
        $mediaType = $hasMedia ? $this->faker->randomElement(['image','video']) : null;

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.substr(uniqid(), -5),
            'chapo' => $this->faker->sentence(12),
            'content' => '<p>'.$this->faker->paragraphs(5, true).'</p>',
            'featured_media_id' => null, // set in seeder to associate real media
            'media_type' => $mediaType,
            'status' => 'published',
            'author_id' => null,
            'tags' => fake()->randomElements(
                ['politique', 'culture', 'sport', 'économie', 'international', 'divertissement'],
                fake()->numberBetween(1, 3)
            ),
            'seo_title' => null,
            'seo_description' => null,
            'views_count' => $this->faker->numberBetween(10,5000),
            'published_at' => now()->subDays($this->faker->numberBetween(0,30)),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
