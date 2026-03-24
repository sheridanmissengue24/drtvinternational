<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PodcastEpisode;
use App\Models\MediaItem;

class PodcastSeeder extends Seeder
{
    public function run()
    {
        // create some podcast media items then episodes
        $pod = MediaItem::factory()->count(3)->create(['type' => 'podcast']);
        foreach ($pod as $p) {
            PodcastEpisode::factory()->create(['media_item_id' => $p->id, 'audio_path' => $p->file_path]);
        }
    }
}
