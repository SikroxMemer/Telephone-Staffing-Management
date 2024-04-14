<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Puce;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Puce>
 */
class PuceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Puce::class;
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['vocale' , 'internet']) , 
            'fourniseur' => $this->faker->randomElement(['orange','inwi' , 'maroc telecome']) ,
            'telephone' => $this->faker->phoneNumber(),
            'is_active' => $this->faker->boolean() ,
        ];
    }
}
