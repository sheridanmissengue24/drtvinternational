<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobOffer>
 */
class JobOfferFactory extends Factory
{
    protected $model = \App\Models\JobOffer::class;

    public function definition()
    {
        $title = $this->faker->jobTitle();
        return [
            'title' => $title,
            'description' => $this->faker->paragraphs(3, true),
            'location' => $this->faker->city(),
            'slug' => Str::slug($title).'-'.substr(uniqid(), -4),
            'published_at' => now()->subDays($this->faker->numberBetween(0,30)),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
