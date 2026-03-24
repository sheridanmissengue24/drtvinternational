<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MediaItem;

class MediaItemsTableSeeder extends Seeder
{
    public function run()
    {
        // Placeholder images & video items
        MediaItem::factory()->count(8)->create();
    }
}
