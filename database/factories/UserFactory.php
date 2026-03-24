<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition()
    {
        $name = $this->faker->name();
        return [
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password123'), // sensible default for dev
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function admin()
    {
        return $this->state(fn() => ['role' => 'admin']);
    }
}
