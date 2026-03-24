<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VodVideo;
use App\Models\MediaItem;

class VodSeeder extends Seeder
{
    public function run()
    {
        $mi = MediaItem::where('type','video')->get();
        foreach ($mi as $m) {
            VodVideo::factory()->create([
                'media_item_id' => $m->id,
                'mp4_path' => $m->file_path,
                'transcoding_status' => 'done',
            ]);
        }
    }
}
