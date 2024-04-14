<?php

namespace Database\Seeders;

use App\Models\Affectation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AffectationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Affectation::factory()->count(50)->create();
    }
}
