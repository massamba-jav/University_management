<?php

namespace Database\Seeders;

use App\Models\Departement;
use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // nécessite des filières existantes
        Departement::factory()->count(5)->create();
    }
}
