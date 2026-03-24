<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClientSubmission;

class ClientSubmissionsSeeder extends Seeder
{
    public function run()
    {
        ClientSubmission::factory()->count(6)->create();
    }
}
