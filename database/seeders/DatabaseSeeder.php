<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // Core data
         $this->call([
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            MediaItemsTableSeeder::class,
            LiveStreamsSeeder::class,
        ]);

        // Content
        $this->call([
            ActualitesTableSeeder::class,
            VodSeeder::class,
            PodcastSeeder::class,
            SubscribersSeeder::class,
            ClientSubmissionsSeeder::class,
            JobsAndApplicationsSeeder::class,
            UrgentInfoSeeder::class,
            ProgrammeSeeder::class,
        ]);

        // if (Schema::hasTable('settings')) {
        //     try {
        //         \DB::table('settings')->insertOrIgnore([
        //             ['key' => 'apk_url', 'value' => 'https://cdn.example.com/drtv/drtv_v1.0.0.apk'],
        //             ['key' => 'apk_version', 'value' => '1.0.0'],
        //             ['key' => 'apk_notes', 'value' => 'Signed APK. SHA256: abcdef...'],
        //         ]);
        //     } catch (\Throwable $e) {
        //         // ignore on failure
        //     }
        // }
    }
}
