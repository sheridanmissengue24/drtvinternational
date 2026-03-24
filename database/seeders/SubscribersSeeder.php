<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subscriber;

class SubscribersSeeder extends Seeder
{
    public function run()
    {
        Subscriber::factory()->count(50)->create();
    }
}
