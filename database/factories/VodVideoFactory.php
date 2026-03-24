<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VodVideo>
 */
class VodVideoFactory extends Factory
{
    protected $model = \App\Models\VodVideo::class;

    public function definition()
    {
        return [
            'hls_path' => null,
            'mp4_path' => 'images/medias/video-sample.mp4',
            'transcoding_status' => 'done',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
