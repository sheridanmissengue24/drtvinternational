<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LiveStream;

class LiveStreamsSeeder extends Seeder
{
    public function run()
    {
        LiveStream::factory()->create([
            'name' => 'DRTV TV',
            'type' => 'tv',
            'hls_url' => null,
            'embed_code' => null,
            'status' => 'active',
        ]);
    }
}
