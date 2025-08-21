<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;
use App\Models\Addresses;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'person_name' => fake()->firstName(),
            'person_surname_1' => fake()->lastName(),
            'person_surname_2' => fake()->lastName(),
            'person_email' => fake()->email(),
            'person_address_id' => Addresses::factory()->create(),
        ];
    }
}