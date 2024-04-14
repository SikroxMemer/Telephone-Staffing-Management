<?php

namespace Database\Seeders;

use App\Models\Puce;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PuceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Puce::factory()->count(1500)->create();
    }
}
