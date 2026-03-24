<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobOffer;
use App\Models\Application;

class JobsAndApplicationsSeeder extends Seeder
{
    public function run()
    {
        $offers = JobOffer::factory()->count(4)->create();

        foreach ($offers as $offer) {
            Application::factory()->count(rand(0,5))->create(['job_offer_id' => $offer->id]);
        }
    }
}
