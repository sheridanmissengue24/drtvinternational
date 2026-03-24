<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UrgentInfo;

class UrgentInfoSeeder extends Seeder
{
    public function run()
    {
        UrgentInfo::factory()->create([
            'title' => 'Alerte météo : fortes pluies prévues',
            'message' => 'Des fortes pluies sont attendues dans plusieurs provinces. Suivez les consignes de sécurité.',
            'level' => 'warning',
            'active' => true,
            'starts_at' => now()->subHour(),
            'ends_at' => now()->addDay(),
        ]);
    }
}
