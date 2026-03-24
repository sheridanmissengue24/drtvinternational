<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $names = [
            ['name' => 'Politique','slug'=>'politique','color'=>'#d81b60'],
            ['name' => 'Économie','slug'=>'economie','color'=>'#ff7043'],
            ['name' => 'Culture','slug'=>'culture','color'=>'#7c4dff'],
            ['name' => 'Sport','slug'=>'sport','color'=>'#03a9f4'],
            ['name' => 'Santé','slug'=>'sante','color'=>'#4caf50'],
        ];

        foreach ($names as $n) {
            Category::create($n);
        }

        // random extras
        Category::factory()->count(3)->create();
    }
}
