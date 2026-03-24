<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Actualite;
use App\Models\MediaItem;
use App\Models\Category;
use App\Models\User;

class ActualitesTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $categories = Category::all();
        $medias = MediaItem::all();

        // Create 15 actualités and attach categories & featured media
        Actualite::factory()->count(15)->make()->each(function($a) use ($users, $categories, $medias) {
            // assign author
            $a->author_id = $users->random()->id;
            $a->save();

            // attach 1-2 categories
            $attach = $categories->random(rand(1,2))->pluck('id')->toArray();
            $a->categories()->sync($attach);

            // attach featured media optionally
            if ($medias->isNotEmpty() && rand(0,1)) {
                $media = $medias->random();
                $a->featured_media_id = $media->id;
                $a->media_type = $media->type === 'image' ? 'image' : 'video';
                $a->save();
            }
        });
    }
}
