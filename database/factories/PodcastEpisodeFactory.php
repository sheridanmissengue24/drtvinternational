<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PodcastEpisode>
 */
class PodcastEpisodeFactory extends Factory
{
    protected $model = \App\Models\PodcastEpisode::class;

    public function definition()
    {
        return [
            'audio_path' => 'podcasts/podcast-sample.mp3',
            'rss_guid' => (string) $this->faker->uuid(),
            'duration' => $this->faker->numberBetween(300,3600),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
