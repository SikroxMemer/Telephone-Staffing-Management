<?php

namespace Database\Factories;

use App\Models\Affectation;
use App\Models\Personnel;
use App\Models\Puce;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AffectationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Affectation::class;
    public function definition(): array
    {
        return [
            'observation' => $this->faker->name(),
            'date_affectation' => $this->faker->date(),
            'puce' => $this->faker->randomElement(Puce::all()->pluck('id')->toArray()),
            'personnel' => $this->faker->randomElement(Personnel::all()->pluck('id')->toArray()),
        ];
    }
}
