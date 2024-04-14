<?php

namespace Database\Factories;

use App\Models\Entity;
use App\Models\Personnel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personnel>
 */
class PersonnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Personnel::class;
    public function definition(): array
    {
        return [
            'matricule' => $this->faker->numerify("######"),
            'nom' => $this->faker->firstName(),
            'prenom' => $this->faker->lastName(),
            'entity' => $this->faker->randomElement(Entity::all()->pluck('id')->toArray()),
        ];
    }
}
