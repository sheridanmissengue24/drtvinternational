<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LiveStream>
 */
class LiveStreamFactory extends Factory
{
    protected $model = \App\Models\LiveStream::class;

    public function definition()
    {
        return [
            'name' => 'DRTV Live',
            'type' => 'tv',
            'hls_url' => null,
            'embed_code' => '<iframe src="https://youtu.be/Q1GDN4cS2ho?si=NT6Kk0XIwgCr5c-Q" />',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
