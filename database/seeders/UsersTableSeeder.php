<?php
// filepath: /C:/Users/Administrator/OneDrive/Bureau/projects/devWeb/laravel/wokspace/drtv-web/database/seeders/UsersTableSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $hasRole = Schema::hasColumn('users', 'role');

        // Admin (idempotent) - password requis
        $adminAttrs = [
            'name' => 'Admin DRTV',
            'password' => Hash::make('admin12345'), // changez si besoin
        ];

        if ($hasRole) {
            $adminAttrs['role'] = 'admin';
        }

        $admin = User::updateOrCreate(
            ['email' => 'admin@drtv.cg'],
            $adminAttrs
        );

        // Users de test (factory doit définir un password; sinon on force après)
        $users = User::factory()->count(6)->create();

        // Fallback si votre factory ne met pas de password (sécurité/robustesse)
        foreach ($users as $u) {
            if (empty($u->password)) {
                $u->password = Hash::make('password');
                $u->save();
            }
        }
    }
}