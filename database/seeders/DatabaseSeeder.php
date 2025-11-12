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
        // utilisateur de test
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // ordre important : filières d'abord, puis modules/étudiants qui dépendent des filières
        $this->call([
            DepartementSeeder::class,
            FiliereSeeder::class,
            ProfesseurSeeder::class,
            EtudiantSeeder::class,
        ]);
    }
}
