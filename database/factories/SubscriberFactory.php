<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscriber>
 */
class SubscriberFactory extends Factory
{
    protected $model = \App\Models\Subscriber::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'source' => $this->faker->randomElement(['footer','hero','campaign','popup']),
            'subscribed_at' => now()->subDays($this->faker->numberBetween(0,365)),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
