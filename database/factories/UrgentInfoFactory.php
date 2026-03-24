<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UrgentInfo>
 */
class UrgentInfoFactory extends Factory
{
    protected $model = \App\Models\UrgentInfo::class;

    public function definition()
    {
        return [
            'title' => 'Info urgente: '.$this->faker->words(3, true),
            'message' => $this->faker->sentence(12),
            'level' => $this->faker->randomElement(['info','warning','danger']),
            'active' => true,
            'starts_at' => now()->subHours(2),
            'ends_at' => now()->addDays(1),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
