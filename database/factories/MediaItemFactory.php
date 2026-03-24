<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MediaItem>
 */
class MediaItemFactory extends Factory
{
    protected $model = \App\Models\MediaItem::class;

    public function definition()
    {
        $types = ['image','video','live','radio','podcast'];
        $type = $this->faker->randomElement($types);
        $file = $type === 'image'
            ? 'images/medias/news-'.$this->faker->numberBetween(1,8).'.jpg'
            : 'images/medias/placeholders/video-sample.mp4';

        return [
            'title' => $this->faker->sentence(6),
            'type' => $type,
            'description' => $this->faker->paragraph(),
            'file_path' => $file,
            'poster_path' => 'images/medias/thumb-'.$this->faker->numberBetween(1,8).'.jpg',
            'duration' => $type === 'video' ? $this->faker->numberBetween(30,600) : null,
            'mime' => $type === 'image' ? 'image/jpeg' : 'video/mp4',
            'visibility' => 'public',
            'created_by' => null,
            'published_at' => now()->subDays($this->faker->numberBetween(0,30)),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
