<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientSubmission>
 */
class ClientSubmissionFactory extends Factory
{
    protected $model = \App\Models\ClientSubmission::class;

    public function definition()
    {
        return [
            'client_name' => $this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'message' => $this->faker->paragraph(),
            'attachments' => null,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
